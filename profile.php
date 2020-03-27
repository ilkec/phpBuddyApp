<?php

include_once(__DIR__ .'/classes/User.php');
include_once(__DIR__ . '/classes/Db.php');


$user = new User();
session_start();
$user->setEmail($_SESSION['user']);
$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']);
//var_dump($databaseId['id']);
$getAllUser = $user->getAll();

    //// stap 1) maak je variabele voor alle data in te stoppen bv $email= $getAllUser[0]['email']
    //// stap 2) zet rond elke stap bv if(!empty($_POST['email])  {  $email = $_post  })
    //// als je sommige velden verplicht maakt kan je die buiten if zetten
    //// geen else want niet invullen is ok, dat mag -> dan nemen we gewoon de waarde van stap  (wat er al in database zit)
    ////stap 3 verwijder alle onnodige code voor duidelijk -> setters en getter van passwordOld en passwordDatabase nog ergens gebruikt? tip: F3 en geef de naam in en kijk in alle files waar deze naam voorkomt
    //// stap 4 al gedaan, update, MAAR let wel op dat alle bv: $user-setEmail($_post['email]) in if statements zitten (stap2)
    
       
    $firstname = $getAllUser['firstname'];
    $lastname = $getAllUser['lastname'];
    $email = $getAllUser['email'];
    $passwordDatabase = $getAllUser['password'];
    $profilePicture = $getAllUser['picture'];

    if(!empty($_POST['updateProfile'])){
        try {
                    $user->setFirstname($_POST['firstname']);
                    $user->setLastname($_POST['lastname']);
                    $user->setDescription($_POST['profileText']);
                    $user->updateProfile();
        } 
        catch (\Throwable $th) {
                $error = $th->getMessage();
        }
    }

    if(!empty($_POST['updatePhoto'])){
        $user->setProfilePicture($_FILES["fileUpload"]["name"]);
        
        $upload_dir = __DIR__ . "/uploads/";
        
        $upload_file = $upload_dir . basename($_FILES["fileUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($upload_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["updatePhoto"])) {
            $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
            if($check !== false) {
                //"File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $errorPhoto = "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check file size
        if ($_FILES["fileUpload"]["size"] > 500000) {
            $errorPhoto = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if($getAllUser['picture'] === ""){
        // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $errorPhoto = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
        }}
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $upload_file)) {
                $errorPhoto = "The file ". basename( $_FILES["fileUpload"]["name"]). " has been uploaded.";
            } else {
                $errorPhoto =  "Sorry, there was an error uploading your file.";
            }
        }
        $user->updatePicture();
    }



    if(!empty($_POST['updatePassword'])){
        if(!empty($_POST['passwordOld']) && !empty($_POST['passwordNew'])){
            $password = password_hash($_POST['passwordNew'], PASSWORD_DEFAULT, ['cost' => 14]);
            $user->setPasswordNew($password);
            $oldPassword = $_POST['passwordOld'];
            if($user->checkPassword($oldPassword) == true){
                 $user->updatePassword();
            }else{
                $error = "Oud wachtwoord is niet correct. Gelieve opnieuw te proberen.";
            }
        }

        if(empty($_POST['passwordOld']) && !empty($_POST['passwordNew'])){
            $error = "Oud wachtwoord moet ingevuld zijn voor u een nieuw wachtwoord kan instellen";
        }
        if(empty($_POST['passwordOld']) && empty($_POST['passwordNew'])){
            $error = "Je kan geen wachtwoord wijzigen. Gelieve de juiste velden in te vullen.";
        }

       

    }

    if(!empty($_POST['updateEmail'])){
        if(!empty($_POST['passwordEmail']) && !empty($_POST['email'])){
            $passwordEmail = $_POST['passwordEmail'];
            if($user->checkPassword($passwordEmail) == true){
                $user->setEmail($_POST['email']);
                $user->updateEmail();

            }else{
                // + velden oud wachtwoord en nieuw wachtwoord leegmaken in form
                $errorEmail = "Wachtwoord is niet correct. Gelieve opnieuw te proberen.";
            }
        }

        if(empty($_POST['passwordEmail']) && !empty($_POST['email'])){
            // + veld nieuw wachtwoord leegtmaken in form
            $errorEmail = "Wachtwoord moet ingevuld zijn voor u een nieuw emailadres kan instellen";
        }
}

    $getAllUser = $user->getAll();
    
   

    

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
    <link rel="stylesheet" href="css/style.css">
    <title>Profile</title>
    <style>
        
        label{
            display: block;
        }
        .form_field{
            margin:10px;
        }
        .profilePicture{
            width: 180px;
            height: 180px;
            /*background-color: grey;*/

        }



    </style>
</head>
<body>
    <div class="bg">
       <!--<h2 class="container mt-5 w-25">Persoonlijke gegevens</h2>-->
        <!-------form picture------>
        <form class="container w-25 border border-primary rounded" action="" method="post" enctype="multipart/form-data">
        <h3>Profielfoto toevoegen</h3>
            <div class="form__field mt-2">
                <img src="<?php if($getAllUser['picture'] === ""){
                    echo "uploads/profilePic.png";
                    } else{
                        echo "uploads/" . $getAllUser['picture'];} ?>" alt="profiel foto" class="profilePicture">
                <input  type="file" name="fileUpload" class="btn mb-3" id="fileUpload">
                <?php if(isset($errorPhoto)):?>
				<div class="form__error">
					<p>
						<?php echo $errorPhoto; ?>
					</p>
				</div>
				<?php endif; ?>
                
                <input type="submit" value="Opslaan" class="btn btn-primary mb-3" id="btnOpslaan" name="updatePhoto"> 
            </div>
        </form>
            <!-------form algemeen------>
        <form class="container w-25 border border-primary rounded" action="" method="post" enctype="multipart/form-data">
        <h3>Persoonlijke gegevens</h3>
            <div class="form_field mt-2">
                <label for="profileText">Korte beschrijving</label>
                <textarea  class="form-control" type="text" placeholder="Korte beschrijving" name="profileText" id="profileText"><?php echo $getAllUser['description'];?></textarea>
            </div>
            <div class="form_field mt-2">
                <label for="firstname">Voornaam</label>
                <input  class="form-control" type="text" value="<?php  echo $getAllUser['firstname'];?>" name="firstname" id="firstname">
            </div>
            <div class="form_field mt-2">
                <label for="lastname">Achternaam</label>
                <input class="form-control"  type="text"value="<?php  echo $getAllUser['lastname'];?>" name="lastname" id="lastname">
            </div>
            
            <div class="form_field mt-2">
                <input type="submit" value="Opslaan" class="btn btn-primary mb-3" id="btnOpslaan" name="updateProfile"> 
            </div>
        </form>
            <!-------form email------>
        <form class="container w-25 border border-primary rounded" action="" method="post" enctype="multipart/form-data">
        <h3>Emailadres wijzigen</h3>
            <div class="form_field mt-2">
                <label for="email">Emailadres</label>
                <input class="form-control" type="text" value="<?php  echo $getAllUser['email'];?>" name="email" id="email">
            </div>
            <div class="form_field mt-2">
                <label for="passwordNew">Wachtwoord</label>
                <input class="form-control"  type="password" placeholder="Wachtwoord" name="passwordEmail" id="passwordEmail">
            </div>
            <div>
            <input type="submit" value="Emailadres wijzigen" class="btn btn-primary mb-3" id="btnOpslaan" name="updateEmail">
            </div>
            <?php if(isset($errorEmail)):?>
				<div class="form__error">
					<p>
						<?php echo $errorEmail; ?>
					</p>
				</div>
				<?php endif; ?>
        </form>
        <!-------form wachtwoord------>
        <form class="container w-25 border border-primary rounded" action="" method="post" enctype="multipart/form-data">
        <h3>Wachtwoord wijzigen</h3>
        <div class="form_field mt-2">
                <label for="passwordOld">Oud wachtwoord</label>
                <input class="form-control"  type="password" placeholder="oud wachtwoord" name="passwordOld" id="passwordOld">
            </div>
            <div class="form_field mt-2">
                <label for="passwordNew">Nieuw wachtwoord</label>
                <input class="form-control"  type="password" placeholder="nieuw wachtwoord" name="passwordNew" id="passwordNew">
            </div>
            <div>
            <input type="submit" value="Wachtwoord wijzigen" class="btn btn-primary mb-3" id="btnOpslaan" name="updatePassword">
            </div>
            <?php if(isset($error)):?>
				<div class="form__error">
					<p>
						<?php echo $error; ?>
					</p>
				</div>
				<?php endif; ?>
        </form>
    </div>
    
</body>
</html>