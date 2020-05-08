<?php

include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/doSearchStuff.php');

$user = new User();

session_start();
$user->setEmail($_SESSION['otherUser']);
$other = $user->getDatabaseId();

var_dump($_SESSION);

if (isset($_SESSION['targetUser'])) {
    $getOther = $user->getOther();
} else {
    /*header("Location: feature2.php");*/
    echo'you fucked up again :D';
}

if (isset($_POST['return'])) {
    session_start();
    session_unset();
    session_destroy();

    header("Location: feature2.php");
    exit;
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
    
</style>

<body>
    
   
    <div class="full">

    </nav>
    <section class="container-fluid">
        <div id="profile" class="">
            
            <div class="profile1" > 
                <div class="profilePictureWrap">
                <img src="<?php if ($getOther['picture'] === NULL) {
                                echo "uploads/profilePic.png";
                            } else {
                                echo "uploads/" . $getOther['picture'];
                            } ?>" alt="profiel foto" class="profilePicture">
                 </div>   
                  
                 
                        
        
            </div>
            <!------profiel------->
            <div id="p-interests">
                <div>
                    <h3><?php echo htmlspecialchars($getOther['firstname']) . " " . htmlspecialchars($getOther['lastname']); ?></h3>
                </div>
                <div>
                    <h5>Bio</h5>
                    <p><?php echo htmlspecialchars($getOther['description']); ?></p>
                </div>

                <div>
                    <h5>I like</h5>
                    <ul id='show_profileOtherUser'>
                        <li><?php echo $getOther['games']; ?> </li>
                        <li><?php echo $getOther['books']; ?></li>
                        <li><?php echo $getOther['films']; ?></li>
                        <li><?php echo $getOther['music']; ?></li>
                    </ul>
                    <h5>Buddy</h5>
                    
                     
                        <form class="btn btn-primary" action="" method="post">
                         
                            <a href="sortBuddy.php" class="back" type="submit" value="Log in">Back</a>
                        </form>
                     
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>