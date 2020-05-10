<?php

include_once(__DIR__ . '/classes/User.php');
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

if (isset($_SESSION['user'])) {
    if (!empty($_POST['updateProfile'])) {
        try {
            $user->setFirstname($_POST['firstname']);
            $user->setLastname($_POST['lastname']);
            $user->setDescription($_POST['profileText']);
            $user->updateProfile();
        } catch (\Throwable $th) {
            $errorProfile = $th->getMessage();
        }
    }

    if (!empty($_POST['updatePhoto'])) {
        
        $upload_dir = __DIR__ . "/uploads/";
        $upload_file = $upload_dir . date('dmYHis') . basename($_FILES["fileUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["updatePhoto"])) {
            $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
            if ($check !== false) {
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
        if ($getAllUser['picture'] === "") {
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $errorPhoto = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $upload_file)) {
                $errorPhoto = "The file " . basename($_FILES["fileUpload"]["name"]) . " has been uploaded.";
            } else {
                $errorPhoto =  "Sorry, there was an error uploading your file.";
            }
        }
        $user->setProfilePicture(date('dmYHis') . $_FILES["fileUpload"]["name"]);
        $user->updatePicture();
    }



    if (!empty($_POST['updatePassword'])) {
        if (!empty($_POST['passwordOld']) && !empty($_POST['passwordNew'])) {
            if(strlen($_POST['passwordNew']) < 8 ) {
                $errorPassword = "Password must be at least 8 characters long";
            } else {
                $password = password_hash($_POST['passwordNew'], PASSWORD_DEFAULT, ['cost' => 14]);
                $user->setPasswordNew($password);
                $oldPassword = $_POST['passwordOld'];
                if ($user->checkPassword($oldPassword) == true) {
                    $user->updatePassword();
                } else {
                    $errorPassword = "Old password isn't correct. Try again";
                }
            }
           
        }

        else if (empty($_POST['passwordOld']) && !empty($_POST['passwordNew'])) {
            $errorPassword = "You need to fill in your old password.";
        }
        else if (empty($_POST['passwordOld']) && empty($_POST['passwordNew'])) {
            $errorPassword = "Old password and new password need to be filled in";
        }
    }

    if (!empty($_POST['updateEmail'])) {
        if (!empty($_POST['passwordEmail']) && !empty($_POST['email'])) {
            $passwordEmail = $_POST['passwordEmail'];
            if ($user->checkPassword($passwordEmail) == true) {
                $user->setEmail($_POST['email']);
                $user->updateEmail();
            } else {
                // + velden oud wachtwoord en nieuw wachtwoord leegmaken in form
                $errorEmail = "Wachtwoord is niet correct. Gelieve opnieuw te proberen.";
            }
        }

        if (empty($_POST['passwordEmail']) && !empty($_POST['email'])) {
            // + veld nieuw wachtwoord leegtmaken in form
            $errorEmail = "Wachtwoord moet ingevuld zijn voor u een nieuw emailadres kan instellen";
        }
    }
} else {
    header("Location: login.php");
}

$getAllUser = $user->getAll();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Profile Settings</title>
</head>

<body>
<a href="profile.php">
            <img class='back-btn'  src="img/back.png" alt="">
        </a> 
    <div class="container-fluid overflow-auto" id="profileSettingsForm">
        <!-------form picture------>
        <form class="w-80 border-3 rounded-0 mt-3 form-profile-settings" action="" method="post" enctype="multipart/form-data">
            <h3>Add profile picture </h3>
            <div class="form__field mt-2 profileform">
                <div class="profilePictureWrap">
                    <img src="<?php if ($getAllUser['picture'] === NULL) {
                                    echo "uploads/profilePic.png";
                                } else {
                                    echo "uploads/" . $getAllUser['picture'];
                                } ?>" alt="profiel foto" class="profilePicture">
                </div>
                <input type="file" name="fileUpload" class="btn mb-3" id="fileUpload">
                <label for="fileUpload" id="fileUploadLabel" class="btn">Choose a file</label>
                <?php if (isset($errorPhoto)) : ?>
                    <div class="form__error_profile">
                        <p>
                            <?php echo $errorPhoto; ?>
                        </p>
                    </div>
                <?php endif; ?>
                <?php if (isset($errorProfile)) : ?>
                    <div class="form__error_profile">
                        <p>
                            <?php echo $errorProfile; ?>
                        </p>
                    </div>
                <?php endif; ?>
                <?php if (isset($errorEmail)) : ?>
                    <div class="form__error_profile">
                        <p>
                            <?php echo $errorEmail; ?>
                        </p>
                    </div>
                <?php endif; ?>
                <?php if (isset($errorPassword)) : ?>
                    <div class="form__error_profile">
                        <p>
                            <?php echo $errorPassword; ?>
                        </p>
                    </div>
                <?php endif; ?>



                <input type="submit" value="Save" class="btn btn-primary mb-3 btnOpslaan" name="updatePhoto">
            </div>
        </form>
        <!-------form algemeen------>
        <form class="w-80 border-3 rounded-0 form-profile-settings" action="" method="post" enctype="multipart/form-data">
            <h3>Personal info</h3>
            <div class="form_field mt-2 profileform">
                <label for="profileText">Bio</label>
                <textarea class="form-control" type="text" placeholder="Bio" name="profileText" id="profileText"><?php echo $getAllUser['description']; ?></textarea>
            </div>
            <div class="form_field mt-2 profileform">
                <label for="firstname">Firstname</label>
                <input class="form-control" type="text" value="<?php echo $getAllUser['firstname']; ?>" name="firstname" id="firstname">
            </div>
            <div class="form_field mt-2 profileform">
                <label for="lastname">Lastname</label>
                <input class="form-control" type="text" value="<?php echo $getAllUser['lastname']; ?>" name="lastname" id="lastname">
            </div>
            <?php if (isset($errorProfile)) : ?>
                <div class="form__error_profile">
                    <p>
                        <?php echo $errorProfile; ?>
                    </p>
                </div>
            <?php endif; ?>

            <div class="form_field mt-2 profileform">
                <input type="submit" value="Save" class="btn btn-primary mb-3 btnOpslaan" name="updateProfile">
            </div>
        </form>
        <!-------form email------>
        <form class="w-80 border-3 rounded-0 form-profile-settings" action="" method="post" enctype="multipart/form-data">
            <h3>Change email address</h3>
            <div class="form_field mt-2 profileform">
                <label for="email">Email address</label>
                <input class="form-control" type="text" value="<?php echo $getAllUser['email']; ?>" name="email" id="email">
            </div>
            <div class="form_field mt-2 profileform">
                <label for="passwordNew">Password</label>
                <input class="form-control" type="password" placeholder="Password" name="passwordEmail" id="passwordEmail">
            </div>
            <?php if (isset($errorEmail)) : ?>
                <div class="form__error_profile">
                    <p>
                        <?php echo $errorEmail; ?>
                    </p>
                </div>
            <?php endif; ?>
            <div>
                <input type="submit" value="Save" class="btn btn-primary mb-3 btnOpslaan" name="updateEmail">
            </div>
            
        </form>
        <!-------form wachtwoord------>
        <form class="w-80 border-3 rounded-0 mb-3 form-profile-settings" action="" method="post" enctype="multipart/form-data">
            <h3>Change password</h3>
            <div class="form_field mt-2 profileform">
                <label for="passwordOld">Old password</label>
                <input class="form-control" type="password" placeholder="old password" name="passwordOld" id="passwordOld">
            </div>
            <div class="form_field mt-2 profileform">
                <label for="passwordNew">New password</label>
                <input class="form-control" type="password" placeholder="new password" name="passwordNew" id="passwordNew">
            </div>
            <?php if (isset($errorPassword)) : ?>
                <div class="form__error_profile">
                    <p>
                        <?php echo $errorPassword; ?>
                    </p>
                </div>
            <?php endif; ?>
            <div>
                <input type="submit" value="Save" class="btn btn-primary mb-3 btnOpslaan" name="updatePassword">
            </div>
        </form>
        
    </div>

</body>

</html>