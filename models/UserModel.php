<?php
require_once("../models/index.php");
require_once('../Message.php');

class UserModel extends DbConection
{

    function getAll()
    {
        session_start();
        $userId = $_SESSION['id'];
        $query = $this->db->connect()->prepare(
            "SELECT * FROM user WHERE user.id != $userId
            ;"
        );

        try {
            $query->execute();
            $users = $query->fetchAll();
            return $users;
        } catch (PDOException $e) {
            return [];
        }
    }

    function get()
    {
        session_start();
        $userId = $_SESSION['id'];
        $query = $this->db->connect()->prepare(
            "SELECT * FROM user WHERE user.id
            NOT IN (SELECT friend_id as friendId FROM friends
            WHERE friends.user_id = $userId)
            AND user.id <> $userId;");

        try {
            $query->execute();
            $users = $query->fetchAll();
            return $users;
        } catch (PDOException $e) {
            return [];
        }
    }

    function getById($id)
    {
        $query = $this->db->connect()->prepare("SELECT * FROM user WHERE id = $id");

        try {
            $query->execute();
            $user = $query->fetchAll();
            return $user;
        } catch (PDOException $e) {
            return [false, $e];
        }
    }

    function register($fullname, $username, $email, $password, $gender)
    {
        $message = new Message();

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        
        // if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        //     $msg = $message->throwErrorMessage('password-strength');
        //     return ['password-strength', $msg];
        // }

        if (strlen($username) < 3 || strlen($username) > 8) {
            $msg = $message->throwErrorMessage('username-length');
            return ['username-length', $msg];
        }

        $avatar = 'assets/images/defaultProfileImg.png';
        $role = "user";
        $creationDate = date("Y-m-d H:i:s");
        $updatedDate = date("Y-m-d H:i:s");

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->db->connect()->prepare("INSERT INTO user(name, nickname, email, password, gender, avatar, role, created_at, updated_at) 
                                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $query->bindParam(1, $fullname);
        $query->bindParam(2, $username);
        $query->bindParam(3, $email);
        $query->bindParam(4, $hashedPassword);
        $query->bindParam(5, $gender);
        $query->bindParam(6, $avatar);
        $query->bindParam(7, $role);
        $query->bindParam(8, $creationDate);
        $query->bindParam(9, $updatedDate);

        try {
            $query->execute();
            return [true];
        } catch (PDOException $e) {
            $msg = $message->throwErrorMessage('user-or-email-not-valid');
            return ['user-or-email-not-valid', $msg, $e];
        } 
    }

    function update($id, $fullname, $username, $gender, $avatar)
    {
        $updatedDate = date("Y-m-d H:i:s");

        $query = $this->db->connect()->prepare("UPDATE user
        SET name = ?, nickname = ?, gender = ?, avatar = ?, updated_at = ? 
        WHERE id = ?;");

        $query->bindParam(1, $fullname);
        $query->bindParam(2, $username);
        $query->bindParam(3, $gender);
        $query->bindParam(4, $avatar);
        $query->bindParam(5, $updatedDate);
        $query->bindParam(6, $id);

        try {
            $query->execute();
            return [true];
        } catch (PDOException $e) {
            return [false, $e];
        }
    }

    function login($username, $email, $password)
    {
        $query = $this->db->connect()->prepare("SELECT * FROM user WHERE (nickname=? OR email=?)");

        $query->bindParam(1, $username);
        $query->bindParam(2, $email);

        try {
            $query->execute();
            $user = $query->rowCount();
            $data = $query->fetch(PDO::FETCH_OBJ);
            if($data){
                $hashedPassword = $data->password;
            }
            $db = null;
            if ($user && password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['id'] = $data->id;
                $_SESSION['name'] = $data->name;
                $_SESSION['nickname'] = $data->nickname;
                $_SESSION['gender'] = $data->gender;
                return [true, "userId" => $_SESSION['id']];
            } else {
                return [false];
            }
        } catch (PDOException $e) {
            return [false, $e];
        }
    }


    function delete($id)
    {
        $query = $this->db->connect()->prepare("DELETE FROM user WHERE id = ?");
        $query->bindParam(1, $id);

        try {
            $query->execute();
            return [true];
        } catch (PDOException $e) {
            return [false, $e];
        }
    }

    function logoutInvalidUser()
    {
        session_start();
        $id = $_SESSION["id"];

        $query = $this->db->connect()->prepare("SELECT * FROM user WHERE id = ?");
        $query->bindParam(1, $id);

        try {
            $query->execute();
            $data = $query->fetch(PDO::FETCH_OBJ);

            if ($data === false) {
                session_destroy();
                header('Location: ');
                return false;
            }
            return true;
        } catch (PDOException $e) {
            return [false];
        }
    }
}
