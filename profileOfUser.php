<?php

include_once(__DIR__ . '/classes/User.php');

$user = new User();

if(!empty($_GET)){
    $getId = $_GET['id'];
    $user->setId($getId);
}

$getAllUser = $user->getAll();


if (isset($_POST['return'])) {
    session_start();
    session_unset();
    session_destroy();

    header("Location: login.php");
    exit;
}

try {
    $allBuddy = $user->profileBuddy();
} catch (\Throwable $th) {
    $allBuddy = "Deze persoon heeft nog geen buddies";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profileOfUser.css">
    <title>Profile</title>
</head>
<style>
    .profilePicture {
        width: 180px;
    }

    #settingsIcon {
        width: 25px;

    }
</style>

<body>
    
   
    <div class="full">

    <a href="sortBuddy.php">
                    <img class='back_btn'  src="img/back.png" alt="">
                </a> 

    </nav>
    <section class="container-fluid">

        <div id="profile" class="">
            
            <div class="profile1" > 
                <div class="profilePictureWrap">
                <img src="<?php if ($getAllUser['picture'] === NULL) {
                                echo "uploads/profilePic.png";
                            } else {
                                echo "uploads/" . $getAllUser['picture'];
                            } ?>" alt="profiel foto" class="profilePicture">
                            
                </div>   

                <a  href="profileSettings.php"><img class="icon1" src="img/settings.png" alt="settingsIcon" id="settingsIcon"></a>
                

                
                                   
            </div>
            <!------profiel------->
            <div id="p-interests">
                <div>
                    <h3 class='firstname'><?php echo htmlspecialchars($getAllUser['firstname']) . " " . htmlspecialchars($getAllUser['lastname']); ?></h3>
                </div>
                <div>
                    <h5 class='bio'>Bio</h5>
                    <p><?php echo htmlspecialchars($getAllUser['description']); ?></p>
                </div>

                <div>
                    <h5 class='intr'>Interests</h5>
                    <ul id='like' class="like">
                        <li><?php echo $getAllUser['games']; ?></li>
                        <li><?php echo $getAllUser['books']; ?></li>
                        <li><?php echo $getAllUser['films']; ?></li>
                        <li><?php echo $getAllUser['music']; ?></li>
                    </ul>
                    
                     
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>