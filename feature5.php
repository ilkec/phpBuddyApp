<?php 

    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");

    $user = new User ();

    session_start();

    $databaseId = $user-> getDatabaseId();
    



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            
    </style>
</head>
<body>
    <div class="imageButton">
        <form action="user.php">
            
            <input type="image" src="img/iab.png" alt="Submit" width="300px" >
            <input type="image" src="img/ihb.png" alt="Submit" width="300px" >
        </form>
            
    </div>
</body>
</html>