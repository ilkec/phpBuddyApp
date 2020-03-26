<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="bg">
        <h2 class="container mt-5 w-25"> Vervolledig u profiel </h2>
        <form class="container w-25 border border-primary rounded" action="" method="post">
            <div class="form__field mt-2">
                <label for="Games">Games</label>
                <input class="form-control" type="text" id="Games" name="games" placeholder="Vul u favoriete game in">
            </div>

            <div class="form__field mt-2">
                <label for="Films">Films</label>
                <input class="form-control" type="text" id="Films" name="films" placeholder="Vul u favoriete film in">
            </div>


            <div class="form__field mt-2">
                <label for="Muziek">Muziek</label>
                <input class="form-control" type="text" id="Muziek" name="muziek" placeholder="Vul u favoriete artiest in">
            </div>


            <div class="form__field mt-2">
                <label for="Locatie">Locatie</label>
                <input class="form-control" type="text" id="Locatie" name="locatie" placeholder="Vul u stad/dorp in">
            </div>


            <div class="form__field mt-2">
                <label for="Boeken">Boeken</label>
                <input class="form-control mb-3" type="text" id="Boeken" name="boeken" placeholder="Vul u favoriete schrijver in">
            </div>

            <input class="btn btn-primary mb-3" type="submit" value="Bevestigen" name="submit_button">
            <?php if (!empty($_POST)) {
                if (empty($_POST['games']) || empty($_POST['films']) || empty($_POST['muziek']) || empty($_POST['locatie']) || empty($_POST['boeken'])) {
                    echo "<h3>Gelieve alle velden in te vullen.</h3>";
                } else {
                    $user = new User();
                    $user->setGames(htmlspecialchars($_POST['games']));
                    $user->setFilms(htmlspecialchars($_POST['films']));
                    $user->setMuziek(htmlspecialchars($_POST['muziek']));
                    $user->setLocatie(htmlspecialchars($_POST['locatie']));
                    $user->setBoeken(htmlspecialchars($_POST['boeken']));
                }
            } ?>

        </form>
    </div>
</body>

</html>