<?php
require_once("../models/index.php");

class FriendsModel extends DbConection
{
    function addFriendUser($friendsId)
    {
        session_start();
        $userId = $_SESSION['id'];
        $condition = $this->db->connect()->prepare("SELECT * FROM friends WHERE $friendsId = user_id AND $userId = friend_id");
        $condition->execute();
        $exists = $condition->rowCount();
        if ($exists){
            $followBack = 'accepted';
            $queryUpdate = $this->db->connect()->prepare("UPDATE friends SET follow_back = (?) WHERE $friendsId = user_id AND $userId = friend_id");
            $queryUpdate->bindParam(1, $followBack);

            $followBack = 'follow back';
            $query = $this->db->connect()->prepare("INSERT INTO friends(user_id, friend_id, follow_back)
            VALUES (?, ?, ?)");
    
            $query->bindParam(1, $_SESSION['id']);
            $query->bindParam(2, $friendsId);
            $query->bindParam(3, $followBack);
            try {
                $query->execute();
                $queryUpdate->execute();
                return [true];
            } catch (PDOException $e) {
                return [false, $e];
            }
        }
        else {
            $followBack = 'pending';
            $query = $this->db->connect()->prepare("INSERT INTO friends(user_id, friend_id, follow_back)
            VALUES (?, ?, ?)");
    
            $query->bindParam(1, $_SESSION['id']);
            $query->bindParam(2, $friendsId);
            $query->bindParam(3, $followBack);
            try {
                $query->execute();
                return [true];
            } catch (PDOException $e) {
                return [false, $e];
            }
        }
    }

    function getFriendsList()
    {
        session_start();
        $userId = $_SESSION['id'];
        $query = $this->db->connect()->prepare(
            "SELECT T.friendId, user.name, user.nickname, user.avatar FROM
                (SELECT friend_id as friendId FROM friends
                    WHERE friends.user_id = $userId) AS T
                        INNER JOIN user ON T.friendId = user.id");
        try {
            $query->execute();
            $friends = $query->fetchAll();
            return $friends;
        } catch (PDOException $e) {
            return [false, $e];
        }
    }

    function deleteFriendUser($friendsId)
    {
        $queryUpdate = $this->db->connect()->prepare("UPDATE user SET denied = 'true' WHERE $friendsId = user.id");
        $queryDelete = $this->db->connect()->prepare("DELETE FROM friends WHERE $friendsId = friend_id");

        try {
            $queryDelete->execute();
            $queryUpdate->execute();
            return [true];
        } catch (PDOException $e) {
            return [false, $e];
        }
    }

    function getNotificationList()
    {
        session_start();
        $userId = $_SESSION['id'];
        $query = $this->db->connect()->prepare("SELECT T.*, user.name, user.nickname, user.avatar FROM
        (SELECT friend_id, user_id FROM friends WHERE $userId = friend_id AND follow_back = 'pending') AS T
                INNER JOIN user ON T.user_id = user.id");
        
        try {
            $query->execute();
            $notifications = $query->fetchAll();
            return $notifications;
        } catch (PDOException $e) {
            return [false, $e];
        }
    }

    function denyFriendRequestUser($friendsId){
        session_start();
        $userId = $_SESSION['id'];
        $followBack = 'denied';
        $query = $this->db->connect()->prepare("UPDATE friends SET follow_back = (?) WHERE $friendsId = user_id AND $userId = friend_id");
        $query->bindParam(1, $followBack);
        try {
            $query->execute();
            return [true];
        } catch (PDOException $e) {
            return [false, $e];
        }
    }
}