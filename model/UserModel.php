<?php

class UserModel extends DbConection
{
    function get()
    {
        $query = $this->db->connect()->prepare("SELECT U.id, U.name, U.email
        FROM user U");

        try {
            $query->execute();
            $users = $query->fetchAll();
            return $users;
        } catch (PDOException $e) {
            return [];
        }
    }
}