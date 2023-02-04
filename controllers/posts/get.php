<?php
require_once('../../models/PostModel.php');

$getPosts = new PostModel();
echo json_encode($getPosts->get());