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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>feature 5</title>

</head>

<body class="container-fluid">
    <div>
        <div class="imageButton row d-flex justify-content-center pt-5">
            <form class="d-flex justify-content-center border-3 border-primary" method="post">

                <input id="firstImg" type="image" src="img/iab.png" width="300px" name="iAmBuddy">
                <input id="scndImg" type="image" src="img/ihb.png" width="300px" name="iWantBuddy">

            </form>
            <p> <?php if (isset($choice)) {
                    echo $choice;
                } else {
                    echo "Please select wether you are looking for a buddy, or want to volunteer as one.";
                } ?> </p>
        </div>
    </div>
</body>

</html>