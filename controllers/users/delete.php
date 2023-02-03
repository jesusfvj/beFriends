<?php
require_once('../../models/UserModel.php');

// $id = $_SESSION["userId"];
$id = 1;
$deleteUser = new UserModel();
echo json_encode($deleteUser->delete($id));
