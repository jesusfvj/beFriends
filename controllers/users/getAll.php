<?php
require_once('../../models/UserModel.php');

$users = new UserModel();
echo json_encode($users->get());
