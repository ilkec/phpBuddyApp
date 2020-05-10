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
    <link rel="stylesheet" href="css/activation.css">
    <title>Document</title>
</head>

<body>
    <div class="log">
        <h2>Your account has been activated!</h2>
        <a href="login.php">Log In</a>
    </div>
</body>

</html>