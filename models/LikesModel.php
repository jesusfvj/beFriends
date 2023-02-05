<?php
require_once("../core/classes/DbConection.php");
require_once("../core/classes/Database.php");
require_once("../config/db.php");

class LikesModel extends DbConection
{
    function getLikesByPost($postId)
    {
        $query = $this->db->connect()->prepare("SELECT COUNT(id) FROM likes WHERE post_id = $postId;");

        try {
            $query->execute();
            $likes = $query->fetchAll();
            return $likes[0][0];
        } catch (PDOException $e) {
            return [];
        }
    }

    function checkUncheckLike($id)
    {
        $queryPosts = $this->db->connect()->prepare("SELECT user_id as userId FROM post WHERE user_id = $id;");

        try {
            $queryPosts->execute();

            session_start();
            $likeUserId = $_SESSION['id'];

            $queryLikesUserId = $this->db->connect()->prepare("SELECT user_id as userId, post_id as postId, COUNT(*) as likes FROM likes WHERE user_id = $likeUserId AND post_id = $id");
            $queryLikesUserId->execute();
            $queryLikesFetch = $queryLikesUserId->fetchAll();

            if ($queryLikesFetch) {
                $userId = $queryLikesFetch[0][0];
                $postId = $queryLikesFetch[0][1];

                if (($userId == $likeUserId) && ($postId == $id)) {
                    $this->dislike($id, $likeUserId);
                    return false;
                } else {
                    $queryInsLike = $this->db->connect()->prepare(
                        "INSERT INTO likes(user_id, post_id)
                            VALUES (?, ?)"
                    );
                    $queryInsLike->bindParam(1, $likeUserId);
                    $queryInsLike->bindParam(2, $id);
                    try {
                        $queryInsLike->execute();
                        return true;

                    } catch (PDOException $e) {
                        return [];
                    }
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return [];
        }
    }

    function dislike($id, $likeUserId)
    {
        $query = $this->db->connect()->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?");
        $query->bindParam(1, $id);
        $query->bindParam(2, $likeUserId);

        try {
            $query->execute();
            return ['removed'];
        } catch (PDOException $e) {
            return [false, $e];
        }
    }
}