<?php
require_once('../../models/UserModel.php');

$id = $_POST['id'];
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$gender = $_POST['gender'];
$avatar = $_POST['avatar'];

$updateUser = new UserModel();
echo json_encode($updateUser->update($id, $fullname, $username, $gender, $avatar));
