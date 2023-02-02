<?php
require_once('../../models/PostModel.php');

// $user_id = $_POST['user_id'];
$user_id = 1;
$content = $_POST['content'];
$image = $_POST['image'];

$post = new PostModel();
echo json_encode($post->create($user_id, $content, $image));
