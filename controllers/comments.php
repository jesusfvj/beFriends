<?php

require_once('../models/commentsModel.php');

$controller = $_GET['controller'];

switch ($controller) {
    case 'addComment':
        addComment();
        break;

    default:
        echo 'Invalid controller';
        break;
}

function addComment()
{
    $commentContent = $_GET['inputComment'];
    $postId = $_GET['commentPostId'];
    $addcomment = new CommentModel();
    echo json_encode($addcomment->addCommentModel($commentContent, $postId));
}
