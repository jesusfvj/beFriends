<?php
require_once('../../models/UserModel.php');

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];

$user = new UserModel();
echo json_encode($user->register($fullname, $username, $email, $password, $gender));
