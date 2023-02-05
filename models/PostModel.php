<?php
require_once("../core/classes/DbConection.php");
require_once("../core/classes/Database.php");
require_once("../config/db.php");

class PostModel extends DbConection
{
    function get()
    {
        // $query = $this->db->connect()->prepare("SELECT P.content as postContent, P.image, P.created_at, P.likes, U.nickname, U.avatar, U.id as postOwner 
        //                                         FROM post P JOIN user U ON U.id = P.user_id
        //                                         ORDER BY P.created_at DESC");
        $query = $this->db->connect()->prepare("
            SELECT T2.*, user.nickname FROM
                (SELECT T.*, comment.content as commentContent, comment.created_at as commentTimeStamp, comment.user_id as commentOwnerId FROM
                    (SELECT user_id, content as postContent, image, likes, post.created_at as postTimeStamp, post.id as postId, user.nickname, user.avatar FROM post 
                    INNER JOIN user ON user.id = post.user_id) AS T
                        INNER JOIN comment ON T.postId = comment.post_id) AS T2 
                            INNER JOIN user ON T2.commentOwnerId = user.id
        ");

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
