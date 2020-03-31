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
    // var_dump($foundmatch);
    ?>
    <h1> Dit zijn je mogelijke matchen om buddy mee te worden.</h1>
    <div>
        <?php
        foreach ($foundmatch as $m) {

            if ($m['games'] == $user->getGames() && $m != $match['email']) {
                echo "<div>";
                echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                echo $m['firstname'] . " ";
                echo $m['lastname'] . "<br>";
                echo "Deze persoon speelt ook graag" . " " . $m['games'] . "games <br>";
                echo "</div>";
            } else
                
            if ($match['music'] == $user->getMusic() && $m != $match['email']) {
                echo "<div>";
                echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                echo $match['firstname'] . " ";
                echo $match['lastname'] . "<br>";
                echo "Deze persoon luistert ook graag" . " " . $match['music'] . "muziek <br>";
                echo "</div>";
            } else
                
            if ($match['location'] == $user->getLocation() && $m != $match['email']) {
                echo "<div>";
                echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                echo $match['firstname'] . " ";
                echo $match['lastname'] . "<br>";
                echo "Deze persoon woont ook in" . " " . $match['location'] . "<br>";
                echo "</div>";
            } else
                
            if ($match['books'] == $user->getBooks() && $match['films'] == $user->getFilms() && $m != $match['email']) {
                echo "<div>";
                echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                echo $match['firstname'] . " ";
                echo $match['lastname'] . "<br>";
                echo "Deze persoon kijkt ook graag" . " " . $match['films'] . "films en leest ook graag" . " " . $match['books'] . "boeken" . "<br>";
                echo "</div>";
            }
        }
        ?>
    </div>
</body>

</html>