<?php

include_once(__DIR__ .'/classes/User.php');
include_once(__DIR__ . '/classes/Db.php');


$user = new User();
$user->setId(1);
$getAllUser = $user->getAll();


if(!empty($_POST)){
    /*if(empty($_POST['password'])){*/
        try {
            
            $user->setEmail($_POST['email']);
            $user->setFirstname($_POST['firstname']);
            $user->setLastname($_POST['lastname']);
            echo $user->getEmail();
            
            $user->update();

            
        } 
        catch (\Throwable $th) {
                $error = $th->getMessage();
        }
    }
    
    


//Gegevens van User ophalen 
//gegevens van user plaatsen in inputvelden behalve wachtwoord
// profilePicutre ophalen uit device van persoon
//profilePicture kunnen opslaan in database = url sturen

//


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
        .profilePicture{
            width: 100px;
            height: 100px;
            background-color: grey;
        }

    </style>
</head>
<body>

    <div class="form">
        <form action="" method="post">
            <h2>Persoonlijke gegevens</h2>
            <div>
                <div class="profilePicture">
                </div>
                <input type="file" class="btn" id="btnBrowse">

            </div>
            <?php /*foreach ($getAllUser as $user) :*/ ?>
            <div class="form_field">
                <label for="firstname">Voornaam</label>
                <input type="text" value=" <?php  echo $getAllUser[0]['firstname'];?> " name="firstname" id="firstname">
            </div>
            <div class="form_field">
                <label for="lastname">Achternaam</label>
                <input type="text"value=" <?php  echo $getAllUser[0]['lastname'];?> " name="lastname" id="lastname">
            </div>
            <div class="form_field">
                <label for="email">Emailadres</label>
                <input type="text" value=" <?php  echo $getAllUser[0]['email'];?> " name="email" id="email">
            </div>
            <!--<div class="form_field">
                <label for="password">Wachtwoord</label>
                <input type="password" placeholder="nieuw wachtwoord" name="password" id="password">
            </div>--->
    <?php /*endforeach; */?>
            <div class="form_field">
                <input type="submit" value="Opslaan" class="btn btn-success" id="btnOpslaan"> 
                <input type="button" value="Cancel" class="btn btn-secondary" id="btnCancel">
            </div>
        </form>
    </div>
    
</body>
</html>