<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");

$conn = Db::getConnection();

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
<style>
    #interestCard{
        border: 1px solid blue;
    }
</style>
</head>

<body>
    <?php
    // var_dump($match);
    // var_dump($foundmatch);
    ?>
    <div class="container-fluid">
        <h1> Dit zijn je mogelijke matchen om buddy mee te worden.</h1>
        <div class="row">
            <a href=""></a>
            <?php
            foreach ($foundmatch as $m) {

                if ($m['games'] == $user->getGames() && $m != $match['email']) {
                    echo "<div id='interestCard'>";
                    echo "<h5>";
                    echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                    echo $m['firstname'] . " ";
                    echo $m['lastname'] . "<br>";
                    echo "Deze persoon speelt ook graag" . " " . $m['games'] . "games <br>";
                    echo "</h5>";
                    echo "<form action='feature8.php' method='post' enctype='multipart/form-data'>
                    <div class='form_field mt-2'>
                        <input type='submit' value='babbeltje doen' class='btn btn-primary mb-3' id='babbelBtn' name='babbelBtn'> 
                    </div>
                    </form>";
                    echo "</div>";
                    // $user->saveMatch();
                    $id = $match['id'];
                    $id2 = $m['id'];
                    $statement = $conn->prepare("INSERT INTO matches(user_id1, user_id2) values ($id, $id2)");
                    $statement->execute();
                } else
                
            if ($m['music'] == $user->getMusic() && $m != $match['email']) {
                    echo "<h5>";
                    echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                    echo $m['firstname'] . " ";
                    echo $m['lastname'] . "<br>";
                    echo "Deze persoon luistert ook graag" . " " . $m['music'] . "muziek <br>";
                    echo "</h5>";
                    // $user->saveMatch();
                    $id = $match['id'];
                    $id2 = $m['id'];
                    $statement = $conn->prepare("INSERT INTO matches(user_id1, user_id2) values ($id, $id2)");
                    $statement->execute();
                } else
                
            if ($m['location'] == $user->getLocation() && $m != $match['email']) {
                    echo "<h5>";
                    echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                    echo $m['firstname'] . " ";
                    echo $m['lastname'] . "<br>";
                    echo "Deze persoon woont ook in" . " " . $m['location'] . "<br>";
                    echo "</h5>";
                    // $user->saveMatch();
                    $id = $match['id'];
                    $id2 = $m['id'];
                    $statement = $conn->prepare("INSERT INTO matches(user_id1, user_id2) values ($id, $id2)");
                    $statement->execute();
                } else
                
            if ($m['books'] == $user->getBooks() && $m['films'] == $user->getFilms() && $m != $match['email']) {
                    echo "<h5>";
                    echo "<img src=uploads/" . $m['picture'] . ">" . "<br>";
                    echo $m['firstname'] . " ";
                    echo $m['lastname'] . "<br>";
                    echo "Deze persoon kijkt ook graag" . " " . $m['films'] . "films en leest ook graag" . " " . $m['books'] . "boeken" . "<br>";
                    echo "</h5>";
                    // $user->saveMatch();
                    $id = $match['id'];
                    $id2 = $m['id'];
                    $statement = $conn->prepare("INSERT INTO matches (user_id1, user_id2) values ($id, $id2)");
                    $statement->execute();
                }
            }
            ?>
        </div>
        <a href="feature5.php" class="btn btn-primary">Mijn profiel</a>
    </div>
</body>

</html>