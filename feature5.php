<?php 

    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");

    $user = new User ();

    session_start();

    $databaseId = $user-> getDatabaseId();

    $buddy = ;
    $lead = ;

    
    $result = $connect_db->mysqli_query("SELECT * FROM matches WHERE matches_ibfk_1 = 'buddy' "); 
    $result = $connect_db->mysqli_query("SELECT * FROM matches WHERE matches_ibfk_2 = 'help' "); 

    
    

 




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
    <div class="images">
        <img class="iab" src="img/iab.png" alt="" height="300px">
        <img class="ihb" src="img/ihb.png" alt="" height="300px">
    </div>
</body>
</html>