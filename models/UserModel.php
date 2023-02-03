<?php
require_once("../../core/classes/DbConection.php");
require_once("../../core/classes/Database.php");
require_once("../../config/db.php");

class UserModel extends DbConection
{
    function get()
    {
        $query = $this->db->connect()->prepare("SELECT * FROM user");

        try {
            $query->execute();
            $users = $query->fetchAll();
            return $users;
        } catch (PDOException $e) {
            return [];
        }
    }

    function register($fullname, $username, $email, $password, $gender)
    {
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
            return [false, $e];
        }
    }


    function login($username, $email, $password)
    {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->db->connect()->prepare("SELECT * FROM user WHERE (name=? OR email=?) AND password=?");

        $query->bindParam(1, $username);
        $query->bindParam(2, $email);
        $query->bindParam(3, $password);


        try {
            $query->execute();
            $user = $query->rowCount();
            $data = $query->fetch(PDO::FETCH_OBJ);
            $db = null;
            if ($user) {
                session_start();
                $_SESSION['id'] = $data->id;
                $_SESSION['name'] = $data->name;
                $_SESSION['nickname'] = $data->nickname;
                $_SESSION['gender'] = $data->gender;
                return [true];
            } else {
                return [false];
            }
        } catch (PDOException $e) {
            return [false, $e];
        }
    }
}
