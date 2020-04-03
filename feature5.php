<?php 
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");

    $user = new User();
    session_start();
    $databaseId = $user->getDatabaseId();
    $user->setId($databaseId);

    if (isset($_SESSION['user'])){
    if(!empty($_POST)){
        if(isset($_POST["iAmBuddy_x"])){
            $choice = "Volunteering for buddy";
            $buddy = 0;
            $user->setBuddy($choice);
            $user->saveChoice();
            header("Location: feature4.php");
        }
        else{
            $choice = "Looking for buddy";
            $buddy = 1;
            $user->setBuddy($choice);
            $user->saveChoice();
            header("Location: feature4.php");
        }

    }
    } else{
        header("Location: feature2.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feature 5</title>
    <style>
            
    </style>
    
</head>
<body>
    <div class="imageButton">
        <form method="post">
            
            <input id="firstImg" type="image" src="img/iab.png" width="300px" name="iAmBuddy">
            <input id="scndImg" type="image" src="img/ihb.png" width="300px" name="iWantBuddy">

        </form>
        <p> <?php if(isset($choice)){
            echo $choice;
        }else{
            echo "Please select wether you are looking for a buddy, or want to volunteer as one.";
        } ?> </p>
    </div>
</body>
</html>