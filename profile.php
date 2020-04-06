<?php 

include_once(__DIR__ .'/classes/User.php');

$user = new User();

session_start();
$user->setEmail($_SESSION['user']);
$databaseId = $user->getDatabaseId();
//var_dump($databaseId);
$user->setId($databaseId['id']);
//var_dump($databaseId['id']);


if( isset($_SESSION['user']) ) {
$getAllUser = $user->getAll();
//var_dump($getAllUser);
}else{
    header("Location: feature2.php");
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
    <title>Document</title>
</head>
<style>
    .profilePicture{
        width: 150px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .section-wrap{
        width: 350px;
        height: 95vh;
        border: 1px solid blue;

    }
    .profile{
        width: 308px;
        margin-left: auto;
        margin-right: auto;
    }

    #settingsIcon{
        width: 24px;
        position: fixed;
        top: 32px;
        left: 308px;
    }

    
</style>
<body>
    <section class="section-wrap">
        <h2>Profiel</h2>
        <a href="profileSettings.php"><img src="img/settings_icon.png" alt="settingsIcon" id="settingsIcon"></a>
            <div class="picture-wrap">
                <img src="<?php if($getAllUser['picture'] === NULL){
                            echo "uploads/profilePic.png";
                            } else{
                             echo "uploads/" . $getAllUser['picture'];} ?>" alt="profiel foto" class="profilePicture">
                        
            </div>
                        <!------profiel------->
            <div class="profile"> 
                 <div>
                    <h3><?php  echo $getAllUser['firstname'] . " " . $getAllUser['lastname'] ;?></h3>
                </div>  
                <div>
                    <h5>Korte beschrijving</h5>
                    <p><?php echo $getAllUser['description'];?></p>
                </div>
                
                <div>
                    <h5>Interesses</h5>
                     <ul>
                         <li><?php  echo $getAllUser['games'];?></li>
                        <li><?php  echo $getAllUser['books'];?></li>
                        <li><?php  echo $getAllUser['films'];?></li>
                        <li><?php  echo $getAllUser['music'];?></li>
                    </ul>
                    <form action="" method="post">
                        <input type="submit" name="return" value="logout">
                    </form>
                            
                </div>
            </div>
            
    </section>           
</body>
</html>