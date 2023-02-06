<?php
require_once("../models/index.php");

class FriendsModel extends DbConection
{
    function addFriendUser($friendsId)
    {
        $query = $this->db->connect()->prepare("INSERT INTO friends(user_id, friend_id)
        VALUES (?, ?)");

        session_start();
        $query->bindParam(1, $_SESSION['id']);
        $query->bindParam(2, $friendsId);

        try {
            $query->execute();
            return [true];
        } catch (PDOException $e) {
            return [false, $e];
        }
    }

    function getFriendsList()
    {
        session_start();
        $userId = $_SESSION['id'];
        $query = $this->db->connect()->prepare("SELECT T.friendId, user.name, user.nickname, user.avatar FROM
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

        $query = $this->db->connect()->prepare("DELETE FROM friends WHERE $friendsId = friend_id");

        try {
            $query->execute();
            return [true];
        } catch (PDOException $e) {
            return [false, $e];
        }
    }
}