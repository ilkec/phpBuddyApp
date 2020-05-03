<?php
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");

$user = new User();
session_start();
$databaseId = $user->getDatabaseId();
$user->setId($databaseId);

if (isset($_SESSION['user'])) {
    if (!empty($_POST)) {
        if (isset($_POST["iAmBuddy_x"])) {
            $choice = "Volunteering for buddy";
            $buddy = 0;
            $user->setBuddy($choice);
            $user->saveChoice();
            header("Location: sortBuddy.php");
        } else {
            $choice = "Looking for buddy";
            $buddy = 1;
            $user->setBuddy($choice);
            $user->saveChoice();
            header("Location: sortBuddy.php");
        }
    }
} else {
    header("Location: feature2.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/chooseBuddy.css">
    <title>feature 5</title>

</head>

<body class="container-fluid">
    <div>
        <div class="">
            <form class="images_div" method="post">

                <input class="images" id="firstImg" type="image" src="img/buddy1.png" width="300px" name="iAmBuddy">
                <input class="images" id="scndImg" type="image" src="img/buddy2.png" width="300px" name="iWantBuddy">

            </form>
            <p> <?php if (isset($choice)) {
                    echo $choice;
                } else {
                    echo "Select";
                } ?> </p>
        </div>
    </div>
</body>

</html>