<?php
require_once("../core/classes/DbConection.php");
require_once("../core/classes/Database.php");
require_once("../config/db.php");

class PostModel extends DbConection
{
    function get()
    {
        $query = $this->db->connect()->prepare("SELECT * FROM post");

        try {
            $query->execute();
            $posts = $query->fetchAll();
            return $posts;
        } catch (PDOException $e) {
            return [];
        }
    }

    function getById($id)
    {
        $query = $this->db->connect()->prepare("SELECT * FROM post WHERE id = $id;");

        try {
            $query->execute();
            $post = $query->fetchAll();
            return $post;
        } catch (PDOException $e) {
            return [];
        }
    }

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

    function delete($id)
    {
        $query = $this->db->connect()->prepare("DELETE FROM post WHERE id = ?");
        $query->bindParam(1, $id);

        try {
            $query->execute();
            return [true];
        } catch (PDOException $e) {
            return [false, $e];
        }
    }
}