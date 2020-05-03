<?php

include_once(__DIR__ . '/classes/User.php');

$user = new User();
session_start();
$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']);

if (isset($_SESSION['user'])) {
    $matches = $user->showMatches();
} else {
    header("Location: feature2.php");
}
//var_dump($matches);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Matches</title>
    <style>
        .card {
            width: 90%;
            margin-bottom: 20px;
        }

        .wrapper {
            margin: 20px 0 0 20px;
        }

        .cards {
            margin-top: 40px;
        }

        .profilePicture {
            display: none;
        }

        .namesMatches{
            text-align: center;
        }

        @media all and (min-width: 768px) {
            .card {
                width: 50%;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 20px;
            }

        

            .profilePicture {
                display: block;
                width: 50px;
                margin-left: auto;
                margin-right: auto;
            }

            .card-body {
                display: grid;
                grid-template-columns: 1fr 3fr 1fr;
            }

        
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h3>Match made between</h3>
        <div class="cards">
            <?php foreach ($matches as $match) : ?>
                <div class="card">
                    <div class="card-body">
                        <img src="<?php if ($match['picture1'] === NULL) {
                                        echo "uploads/profilePic.png";
                                    } else {
                                        echo "uploads/" . $match['picture1'];
                                    } ?>" alt="profiel foto" class="profilePicture">
                        <p class="namesMatches"><?php echo  $match['firstname1'] . " " . $match['lastname1'] . " &amp; " . $match['firstname2'] . " " . $match['lastname2'] ?> </p>
                        <img src="<?php if ($match['picture2'] === NULL) {
                                        echo "uploads/profilePic.png";
                                    } else {
                                        echo "uploads/" . $match['picture2'];
                                    } ?>" alt="profiel foto" class="profilePicture">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>