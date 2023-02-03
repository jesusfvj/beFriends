<?php
require_once('../../models/UserModel.php');
session_start();
$id = $_SESSION["id"];
$deleteUser = new UserModel();
echo json_encode($deleteUser->delete($id));
