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

    case 'getpostsbyuserid':
        getPostsByUserId();
        break;

    case 'createpost':
        createPost();
        break;

    case 'deletepost':
        deletePost();
        break;

    default:
        echo 'Invalid controller';
        break;
}

function getPosts()
{
    $pageAllPost = $_GET['pageAllPost'];
    $getPosts = new PostModel();
    echo json_encode($getPosts->get($pageAllPost));
}

function getPostById()
{
    $id = $_GET['id'];

    $getPostById = new PostModel();
    echo json_encode($getPostById->getPostById($id));
}

function getPostsByUserId()
{
    $userId = intval($_GET['userId']);
    $page = intval($_GET['page']);
    $getPostsByUserId = new PostModel();
    echo json_encode($getPostsByUserId->getPostsByUserId($userId,$page));
}

function createPost()
{
    $user_id = $_SESSION['id'];
    $content = $_POST['content'];
    $image = $_POST['image'];

    $post = new PostModel();
    echo json_encode($post->create($user_id, $content, $image));
}

function deletePost()
{
    $id = $_GET["postid"];

    $deletePost = new PostModel();
    echo json_encode($deletePost->delete($id));
}
