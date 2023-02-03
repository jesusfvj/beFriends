<?php
require_once('../../models/UserModel.php');

$id = $_GET["id"];
$deleteUser = new UserModel();
echo $id;
echo json_encode($deleteUser->delete($id));