<?php
require_once('../model/UserModel.php');

$user = new UserModel();
echo json_encode($user->get());
