<?php
require_once('../../models/PostModel.php');

$id = $_GET["id"];
$deletePost = new PostModel();
echo json_encode($deletePost->delete($id));