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

if (!empty($_POST['btnTalk'])) {
    $idReceiver = $_POST['inputUserId'];
    $_SESSION['chatId'] = $idReceiver;
    header("Location:chat.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        #interestCard {
            border: 1px solid blue;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid"> <a class="navbar-brand" href="feature7.php"><img src="img/Logo.png" width="70em" alt="MyBuddyApp"></a>
            <ul class="pt-2"><a href="feature5.php" class="btn btn-primary">Mijn profiel</a></ul>
        </div>
    </nav>
    <?php
    // var_dump($match);
    // var_dump($foundmatch);
    ?>
    <div class="container-fluid overflow-auto">
        <h1> Dit zijn je mogelijke matchen om buddy mee te worden.</h1>
        <div class="row text-center mr-2">
            <?php
            foreach ($foundmatch as $m) {

                if ($m['games'] == $user->getGames() && $m['id'] != $match['id']) { ?>
                    <div class="col-md-4">
                        <img src="uploads/<?php echo $m['picture'] ?>">
                        <h5> <?php echo htmlspecialchars($m['firstname'] . " " .  $m['lastname']) ?></h5>
                        <h5> Deze persoon speelt ook graag <?php echo htmlspecialchars($m['games']) ?> games. </h5>
                        <form action="" method="post">
                            <input type="hidden" id="inputUserId" name="inputUserId" value="<?php echo htmlspecialchars($m['id']); ?>">
                            <input type="submit" value="Babbeltje doen?" class="btn btn-primary mb-3" id="btnTalk" name="btnTalk">
                        </form>

                    </div>
                <?php
                } else if ($m['music'] == $user->getMusic() && $m['id'] != $match['id']) { ?>
                    <div class="col-md-4">
                        <img src="uploads/<?php echo $m['picture'] ?>">
                        <h5><?php echo htmlspecialchars($m['firstname'] . " " . $m['lastname']) ?> </h5>
                        <h5> Deze persoon luistert ook graag <?php echo htmlspecialchars($m['music']) ?> muziek. </h5>
                        <form action="" method="post">
                            <input type="hidden" id="inputUserId" name="inputUserId" value="<?php echo $m['id']; ?>">
                            <input type="submit" value="Babbeltje doen?" class="btn btn-primary mb-3" id="btnTalk" name="btnTalk">
                        </form>
                    </div>
                <?php
                } else if ($m['location'] == $user->getLocation() && $m['id'] != $match['id']) { ?>
                    <div class="col-md-4">
                        <img src="uploads/<?php echo $m['picture'] ?>">
                        <h5> <?php echo htmlspecialchars($m['firstname'] . " " . $m['lastname']) ?> </h5>
                        <h5> Deze persoon woont ook in <?php echo htmlspecialchars($m['location']) ?> </h5>
                        <form action="" method="post">
                            <input type="hidden" id="inputUserId" name="inputUserId" value="<?php echo $m['id']; ?>">
                            <input type="submit" value="Babbeltje doen?" class="btn btn-primary mb-3" id="btnTalk" name="btnTalk">
                        </form>
                    </div>
                <?php
                } else if ($m['books'] == $user->getBooks() && $m['films'] == $user->getFilms() && $m['id'] != $match['id']) { ?>
                    <div class="col-md-4">
                        <img src="uploads/ <?php echo $m['picture'] ?>">
                        <h5><?php echo htmlspecialchars($m['firstname'] . " " . $m['lastname']) ?></h5>
                        <h5> <br> Deze persoon kijkt ook graag <?php echo htmlspecialchars($m['films']) ?> films en leest ook graag <?php echo htmlspecialchars($m['books']) ?> boeken. <br> </h5>
                        <form action="" method="post">
                            <input type="hidden" id="inputUserId" name="inputUserId" value="<?php echo $m['id']; ?>">
                            <input type="submit" value="Babbeltje doen?" class="btn btn-primary mb-3" id="btnTalk" name="btnTalk">
                        </form>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <a href="feature5.php" class="btn btn-primary">Mijn profiel</a>
    </div>
</body>

</html>