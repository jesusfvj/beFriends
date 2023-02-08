<?php
require_once("../models/index.php");
session_start();
class PostModel extends DbConection
{
    function get()
    {
        $queryPost = $this->db->connect()->prepare("SELECT P.content as postContent, P.image, P.created_at, P.id as postId, U.nickname, U.avatar, U.id as postOwner 
                                                FROM post P JOIN user U ON U.id = P.user_id
                                                ORDER BY P.created_at DESC");


        $queryComments = $this->db->connect()->prepare(
            "SELECT T.*, user.nickname FROM
                (SELECT post.id as postId, comment.content as postContent, comment.user_id as commentOwnerId FROM post 
                    INNER JOIN comment ON post.id = comment.post_id) AS T
                        INNER JOIN user ON T.commentOwnerId = user.id"
        );

        try {
            $queryPost->execute();
            $posts = $queryPost->fetchAll();
            $queryComments->execute();
            $comments = $queryComments->fetchAll();

            for ($i = 0; $i < count($posts); $i++) {
                $postId = intval($posts[$i]['postId']);
                $likesQuery = $this->db->connect()->prepare("SELECT COUNT(id) FROM likes WHERE post_id = $postId");
                $likesQuery->execute();
                $likesCount = $likesQuery->fetchAll();

                $sessionUserId = $_SESSION['id'];

                $isLikedQuery = $this->db->connect()->prepare(
                    "SELECT * FROM likes 
                    WHERE post_id = $postId 
                        AND user_id = $sessionUserId;"
                );
                $isLikedQuery->execute();
                $isLiked = $isLikedQuery->fetchAll();

                $posts[$i]['isLiked'] = count($isLiked) ? true : false;
                $posts[$i]['likesCount'] = $likesCount[0][0];
            }

            foreach ($posts as &$post) {
                $post["comments"] = [];
            }

            for ($i = 0; $i < count($posts); $i++) {
                for ($j = 0; $j < count($comments); $j++) {
                    if ($posts[$i]["postId"] == $comments[$j]["postId"]) {
                        array_push($posts[$i]["comments"], $comments[$j]);
                    }
                }
            }

            return [$posts, $_SESSION["id"]];
        } catch (PDOException $e) {
            return [];
        }
    }

    function getPostById($id)
    {
        $query = $this->db->connect()->prepare("SELECT * FROM post WHERE id = $id;");

        try {
            $query->execute();
            $post = $query->fetchAll();
            return [$post];
        } catch (PDOException $e) {
            return [];
        }
    }

    function getPostsByUserId($userId)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM post P
                WHERE P.user_id = $userId
                ORDER BY P.created_at DESC
            ;"
        );

        try {
            $query->execute();
            $post = $query->fetchAll();
            return [$post];
        } catch (PDOException $e) {
            return [];
        }
    }

    function create($user_id, $content, $image)
    {
        $creationDate = date("Y-m-d H:i:s");
        $updatedDate = date("Y-m-d H:i:s");

        $query = $this->db->connect()->prepare(
            "INSERT INTO post(user_id, content, image, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?)"
        );

        $query->bindParam(1, $user_id);
        $query->bindParam(2, $content);
        $query->bindParam(3, $image);
        $query->bindParam(4, $creationDate);
        $query->bindParam(5, $updatedDate);

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
