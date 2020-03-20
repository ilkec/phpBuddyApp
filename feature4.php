<?php

include_once(__DIR__ . "/classes/User.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1> Gelieve eerst uw profiel te vervolledigen. </h1>
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
        <input type="text" id="Muziek" name="muziek" placeholder="Vul u favoriete album in">
    </div>


    <div class="form__field">
        <label for="Locatie">Locatie</label>
        <input type="text" id="Locatie" name="locatie" placeholder="Vul u stad/dorp in">
    </div>


    <div class="form__field">
        <label for="Boeken">Boeken</label>
        <input type="text" id="Boeken" name="boeken" placeholder="Vul u favoriete boek in">
    </div>

    <a href="index.php"> <button>Bevestigen</button> </a>

</body>

</html>