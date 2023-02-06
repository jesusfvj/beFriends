<?php
require_once("../models/index.php");

class CommentModel extends DbConection
{
    function addCommentModel($commentContent, $postId)
    {
        $query = $this->db->connect()->prepare("INSERT INTO comment (user_id, post_id, content, created_at)
        VALUES (?, ?, ?, ?)");

        $creationDate = date("Y-m-d H:i:s");
        session_start();
        $query->bindParam(1, $_SESSION['id']);
        $query->bindParam(2, $postId);
        $query->bindParam(3, $commentContent);
        $query->bindParam(4, $creationDate);
        try {
            $query->execute();
            return [true];
        } catch (PDOException $e) {
            return [false, $e];
        }
    }
}
