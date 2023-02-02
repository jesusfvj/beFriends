<?php
require_once("../../core/classes/DbConection.php");
require_once("../../core/classes/Database.php");
require_once("../../config/db.php");

class PostModel extends DbConection
{
    function create($user_id, $content, $image)
    {
        $likes = 0;
        $creationDate = date("Y-m-d H:i:s");
        $updatedDate = date("Y-m-d H:i:s");

        $query = $this->db->connect()->prepare("INSERT INTO post(user_id, content, image, likes, created_at, updated_at) 
                                               VALUES (?, ?, ?, ?, ?, ?)");

        $query->bindParam(1, $user_id);
        $query->bindParam(2, $content);
        $query->bindParam(3, $image);
        $query->bindParam(4, $likes);
        $query->bindParam(5, $creationDate);
        $query->bindParam(6, $updatedDate);

        try {
            $query->execute();
            return [true];
        } catch (PDOException $e) {
            return [false, $e];
        }
    }
}
