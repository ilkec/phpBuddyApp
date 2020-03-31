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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <?php
    // var_dump($match);
    // var_dump($foundmatch);
    ?>
    <div class="container-fluid">
        <h1> Dit zijn je mogelijke matchen om buddy mee te worden.</h1>
        <div class="row">
            <?php
            foreach ($foundmatch as $m) {

                if ($m['games'] == $user->getGames() && $m != $match['email']) {
                    echo "<h5>";
                    echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                    echo $m['firstname'] . " ";
                    echo $m['lastname'] . "<br>";
                    echo "Deze persoon speelt ook graag" . " " . $m['games'] . "games <br>";
                    echo "</h5>";
                } else
                
            if ($match['music'] == $user->getMusic() && $m != $match['email']) {
                    echo "<h5>";
                    echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                    echo $match['firstname'] . " ";
                    echo $match['lastname'] . "<br>";
                    echo "Deze persoon luistert ook graag" . " " . $match['music'] . "muziek <br>";
                    echo "</h5>";
                } else
                
            if ($match['location'] == $user->getLocation() && $m != $match['email']) {
                    echo "<h5>";
                    echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                    echo $match['firstname'] . " ";
                    echo $match['lastname'] . "<br>";
                    echo "Deze persoon woont ook in" . " " . $match['location'] . "<br>";
                    echo "</h5>";
                } else
                
            if ($match['books'] == $user->getBooks() && $match['films'] == $user->getFilms() && $m != $match['email']) {
                    echo "<h5>";
                    echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                    echo $match['firstname'] . " ";
                    echo $match['lastname'] . "<br>";
                    echo "Deze persoon kijkt ook graag" . " " . $match['films'] . "films en leest ook graag" . " " . $match['books'] . "boeken" . "<br>";
                    echo "</h5>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>