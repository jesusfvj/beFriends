<?php
require_once('../../models/PostModel.php');
session_start();
$user_id = $_SESSION['id'];
$content = $_POST['content'];
$image = $_POST['image'];

$post = new PostModel();
echo json_encode($post->create($user_id, $content, $image));
