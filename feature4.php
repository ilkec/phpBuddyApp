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
    <h1> Vervolledig u profiel </h1>
    <form action="" method="post">
        <div class="form__field">
            <label for="Games">Games</label>
            <input type="text" id="Games" name="games" placeholder="Vul u favoriete game in">
        </div>

        <div class="form__field">
            <label for="Films">Films</label>
            <input type="text" id="Films" name="films" placeholder="Vul u favoriete film in">
        </div>


        <div class="form__field">
            <label for="Muziek">Muziek</label>
            <input type="text" id="Muziek" name="muziek" placeholder="Vul u favoriete artiest in">
        </div>


        <div class="form__field">
            <label for="Locatie">Locatie</label>
            <input type="text" id="Locatie" name="locatie" placeholder="Vul u stad/dorp in">
        </div>


        <div class="form__field">
            <label for="Boeken">Boeken</label>
            <input type="text" id="Boeken" name="boeken" placeholder="Vul u favoriete schrijver in">
        </div>

        <input type="submit" value="Bevestigen" name="submit_button">
        <?php if (!empty($_POST)) {
            if (empty($_POST['games']) || empty($_POST['films']) || empty($_POST['muziek']) || empty($_POST['locatie']) || empty($_POST['boeken'])) {
                echo "<h3>Gelieve alle velden in te vullen.</h3>";
            } else {
                $games = $_POST['games'];
                $films = $_POST['films'];
                $muziek = $_POST['muziek'];
                $locatie = $_POST['locatie'];
                $boeken = $_POST['boeken'];
            }
        } ?>
    </form>
</body>

</html>