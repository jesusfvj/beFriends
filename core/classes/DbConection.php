<?php

class DbConection
{
    protected $db;
    function __construct()
    {
        $this->db = new Database();
    }
}
