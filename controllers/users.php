<?php
require_once('../models/UserModel.php');

$controller = $_GET['controller'];

switch ($controller) {
    case 'get':
        get();
        break;

    case 'getbyid':
        getById();
        break;

    case 'register':
        register();
        break;

    case 'update':
        update();
        break;

    case 'login':
        login();
        break;

    case 'delete':
        delete();
        break;

    case 'logout':
        logOut();
        break;

    case 'logoutinvaliduser':
        logoutInvalidUser();
        break;

    default:
        echo 'Invalid controller';
        break;
}

function get()
{
    $users = new UserModel();
    echo json_encode($users->get());
}

function getById()
{
    $id = $_GET['user_id'];

    $getUserById = new UserModel();
    echo json_encode($getUserById->getById($id));
}

function register()
{
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    $user = new UserModel();
    echo json_encode($user->register($fullname, $username, $email, $password, $gender));
}

function update()
{
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $avatar = $_POST['avatar'];

    $updateUser = new UserModel();
    echo json_encode($updateUser->update($id, $fullname, $username, $gender, $avatar));
}

function login()
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new UserModel();
    echo json_encode($user->login($username, $email, $password));
}

function delete()
{
    session_start();
    $id = $_SESSION["id"];

    $deleteUser = new UserModel();
    session_destroy();
    echo json_encode($deleteUser->delete($id));
}

function logOut()
{
    session_start();
    session_destroy();
}

function logoutInvalidUser()
{
    $logoutInvalidUser = new UserModel();
    echo json_encode($logoutInvalidUser->logoutInvalidUser());
}