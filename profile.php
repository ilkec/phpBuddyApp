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
            $user->setProfilePicture($_FILES["fileUpload"]["name"]);
           // echo $user->getEmail();
            
            $user->updateSettings();

            
        } 
        catch (\Throwable $th) {
                $error = $th->getMessage();
        }

        $upload_dir = __DIR__ . "/uploads/";
        
        $upload_file = $upload_dir . basename($_FILES["fileUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($upload_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
    
        
        
        // Check file size
        if ($_FILES["fileUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $upload_file)) {
                echo "The file ". basename( $_FILES["fileUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
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
    <div class="bg">
        <h2 class="container mt-5 w-25">Persoonlijke gegevens</h2>
        <form class="container w-25 border border-primary rounded" action="" method="post" enctype="multipart/form-data">
            
            <div class="form__field mt-2">
                <div class="profilePicture"><?php echo $getAllUser[0]['picture'] ?>
                </div>
                <input  type="file" name="fileUpload" class="btn mb-3" id="fileUpload">

            </div>
            <div class="form_field mt-2">
                <label for="profileText">Korte beschrijving</label>
                <textarea  class="form-control" type="text" placeholder="Korte beschrijving" name="profileText" id="profileText"></textarea>
            </div>
            <div class="form_field mt-2">
                <label for="firstname">Voornaam</label>
                <input  class="form-control" type="text" value="<?php  echo $getAllUser[0]['firstname'];?>" name="firstname" id="firstname">
            </div>
            <div class="form_field mt-2">
                <label for="lastname">Achternaam</label>
                <input class="form-control"  type="text"value="<?php  echo $getAllUser[0]['lastname'];?>" name="lastname" id="lastname">
            </div>
            <div class="form_field mt-2">
                <label for="email">Emailadres</label>
                <input class="form-control" type="text" value="<?php  echo $getAllUser[0]['email'];?>" name="email" id="email">
            </div>
            <!--<div class="form_field mt-2">
                <label for="password">Wachtwoord</label>
                <input class="form-control"  type="password" placeholder="nieuw wachtwoord" name="password" id="password">
            </div>--->
    
            <div class="form_field mt-2">
                <input type="button" value="Cancel" class="btn btn-secondary mb-3" id="btnCancel">   
                <input type="submit" value="Opslaan" class="btn btn-primary mb-3" id="btnOpslaan"> 
            </div>
        </form>
    </div>
    
</body>
</html>