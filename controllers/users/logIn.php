<?php
require_once('../../models/UserModel.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


$user = new UserModel();
echo json_encode($user->login($username, $email, $password));