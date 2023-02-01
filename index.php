<?php
require_once("./config/db.php");
require_once("./Database.php");
require_once("./DbConection.php");
require_once("./model/UserModel.php");

$user = new UserModel();
$user->get();
echo "<pre>";
print_r(($user->get()));
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Be_Friends</title>
</head>
<body>
    
</body>
</html>