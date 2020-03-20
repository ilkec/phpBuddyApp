<?php

include_once(__DIR__ .'/classes/User.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Profile</title>
    <style>
        
        label{
            display: block;
        }
        .form_field{
            margin:10px;
        }

    </style>
</head>
<body>

    <div class="form">
        <form action="" method="post">
            <h2>Persoonlijke gegevens</h2>
            <div class="form_field">
                <label for="firstname">Voornaam</label>
                <input type="text" placeholder="Voornaam" name="firstname" id="firstname">
            </div>
            <div class="form_field">
                <label for="lastname">Achternaam</label>
                <input type="text" placeholder="Achternaam" name="lastname" id="lastname">
            </div>
            <div class="form_field">
                <label for="email">Emailadres</label>
                <input type="text" placeholder="Emailadres" name="email" id="email">
            </div>
            <div class="form_field">
                <label for="password">Wachtwoord</label>
                <input type="password" placeholder="Wachtwoord" name="password" id="password">
            </div>
            <div class="form_field">
                <input type="submit" value="Opslaan" class="btn btn-success">
                <input type="submit" value="Cancel" class="btn btn-secondary">
            </div>
        </form>
    </div>
    
</body>
</html>