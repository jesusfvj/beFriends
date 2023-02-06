<?php
require_once('../models/FriendsModel.php');

$controller = $_GET['controller'];

switch ($controller) {
    case 'addfriend':
        addFriend();
        break;

    case 'getfriends':
        getFriends();
        break;
        
        default:
        echo 'Invalid controller';
        break;
    }
    
function addFriend(){
    $friendsId = $_GET['friendid'];

    $addFriendUser = new FriendsModel();
    echo json_encode($addFriendUser->addFriendUser($friendsId));
}

function getFriends(){

    $getFriendsList = new FriendsModel();
    echo json_encode($getFriendsList->getFriendsList());
}