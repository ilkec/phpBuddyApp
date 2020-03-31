<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");


$user = new User();

session_start();
$user->setEmail($_SESSION['user']);
$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']);

$match = $user->getAll();
$user->setGames($match['games']);
$user->setFilms($match['films']);
$user->setMusic($match['music']);
$user->setLocation($match['location']);
$user->setBooks($match['books']);
$user->setEmail($match['email']);

$foundmatch = $user->matchUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // var_dump($match);
    var_dump($foundmatch);
    ?>
    <h1> Dit zijn je mogelijke matchen om buddy mee te worden.</h1>
    <?php
    foreach ($match as $m) {
        if ($match['games'] == $user->getGames() && $user->getEmail() != $match['email']) {
            echo $match['picture'] . "<br>";
            echo $match['firstname'] . " ";
            echo $match['lastname'] . "<br>";
            echo "Deze persoon speelt ook graag" . " " . $match['games'] . "games";
        }

        if ($match['music'] == $user->getMusic()) {
            echo $match['picture'] . "<br>";
            echo $match['firstname'] . " ";
            echo $match['lastname'] . "<br>";
            echo "Deze persoon luistert ook graag" . " " . $match['music'] . "muziek";
        }

        if ($match['location'] == $user->getLocation()) {
            echo $match['picture'] . "<br>";
            echo $match['firstname'] . " ";
            echo $match['lastname'] . "<br>";
            echo "Deze persoon woont ook in" . " " . $match['location'] . "location";
        }
    }
    ?>
</body>

</html>