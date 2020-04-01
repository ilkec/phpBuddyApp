<?php 

    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");

    $user = new User ();

    session_start();

    $databaseId = $user-> getDatabaseId();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["choose"])) {
            $chooseErr = "You need to make a choise";
          } else {
            $choose = test_input($_POST["choose"]);
          }
    }



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
        <input type="radio" name="Choose" <?php if (isset($choose) && $choose=="I am a buddy (1imd)") echo "checked";?> value="I am a buddy (1imd)">I am a buddy (1imd)
        <input type="radio" name="Choose" <?php if (isset($choose) && $choose=="I search a buddy (2 & imd)") echo "checked";?> value="I search a buddy (2 & imd)">I search a buddy (2 & imd)
            
    </div>
</body>
</html>