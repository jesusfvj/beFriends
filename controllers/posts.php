<?php
require_once('../models/PostModel.php');

$controller = $_GET['controller'];

switch ($controller) {
    case 'getposts':
        getPosts();
        break;

    case 'getpostbyid':
        getPostById();
        break;

    case 'createpost':
        createPost();
        break;

    case 'deletepost':
        deletePost();
        break;

    case 'postlike':
        postLike();
        break;

    default:
        echo 'Invalid controller';
        break;
}

function getPosts()
{
    $getPosts = new PostModel();
    echo json_encode($getPosts->get());
}

function getPostById()
{
    $id = $_GET['id'];

    $getPostById = new PostModel();
    echo json_encode($getPostById->getById($id));
}

function createPost()
{
    session_start();
    $user_id = $_SESSION['id'];
    $content = $_POST['content'];
    $image = $_POST['image'];

    $post = new PostModel();
    echo json_encode($post->create($user_id, $content, $image));
}

function deletePost()
{
    $id = $_GET["id"];

    $deletePost = new PostModel();
    echo json_encode($deletePost->delete($id));
}

function postLike()
{
    $id = $_GET['id'];

    $postLike = new PostModel();
    echo json_encode($postLike->postLike($id));
}