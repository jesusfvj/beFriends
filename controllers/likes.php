<?php
require_once('../models/LikesModel.php');

$controller = $_GET['controller'];

switch ($controller) {

    case 'getlikesbypost':
        getLikesByPost();
        break;

    case 'checkunchecklike':
        checkUncheckLike();
        break;

    default:
        echo 'Invalid controller';
        break;
}

function getLikesByPost()
{
    $postId = $_GET['id'];

    $getLikesByPost = new LikesModel();
    echo json_encode($getLikesByPost->getLikesByPost($postId));

}
function checkUncheckLike()
{
    $id = $_GET['id'];

    $checkUncheckLike = new LikesModel();
    echo json_encode($checkUncheckLike->checkUncheckLike($id));
}