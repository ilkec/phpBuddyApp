<?php
    include_once(__DIR__ . "/classes/User.php");
    if(!empty($_GET['id'])){
        $user = new User();
        $user->setId($_GET['id']);
        $user->activateAccount($user->getId());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Your account has been activated!</h2>
    <a href="feature2.php">Log In</a>
</body>
</html>