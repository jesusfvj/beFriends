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

    case 'deletefriend':
        deleteFriends();
        break;

    case 'getnotifications':
        getNotifications();
        break;

    case 'denyfriendrequest':
        denyFriendRequest();
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

function deleteFriends(){
    $friendsId = $_GET['friendid'];

    $deleteFriendUser = new FriendsModel();
    echo json_encode($deleteFriendUser->deleteFriendUser($friendsId));
}

function getNotifications(){
    $getNotificationList = new FriendsModel();
    echo json_encode($getNotificationList->getNotificationList());
}

function denyFriendRequest(){
    $friendsId = $_GET['friendid'];
    $denyFriendRequestUser = new FriendsModel();
    echo json_encode($denyFriendRequestUser->denyFriendRequestUser($friendsId));
}