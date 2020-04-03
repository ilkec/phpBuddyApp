<?php 

include_once(__DIR__ .'/classes/User.php');

$user = new User();

session_start();
$user->setEmail(/*$_SESSION['user']*/"r0448877@student.thomasmore.be");
$databaseId = $user->getDatabaseId();
var_dump($databaseId);
$user->setId($databaseId['id']);
//var_dump($databaseId['id']);
$getAllUser = $user->getAll();
var_dump($getAllUser);



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
    }
</style>
<body>
<h3>Profiel</h3>
            <div">
                <img src="<?php if($getAllUser['picture'] === NULL){
                    echo "uploads/profilePic.png";
                    } else{
                        echo "uploads/" . $getAllUser['picture'];} ?>" alt="profiel foto" class="profilePicture">
            
				</div>
            </div>
        </form>
            <!------profiel------->
        
            <div>
                <h4>Korte beschrijving</h4>
                <p><?php echo $getAllUser['description'];?></p>
            </div>
            <div>
                <h4>Naam</h4>
                <p><?php  echo $getAllUser['firstname'] . " " . $getAllUser['lastname'] ;?></p>
            </div>
            <div>
                <h4>Interesses</h4>
                <ul>
                    <li><?php  echo $getAllUser['games'];?></li>
                    <li><?php  echo $getAllUser['books'];?></li>
                    <li><?php  echo $getAllUser['films'];?></li>
                    <li><?php  echo $getAllUser['music'];?></li>
                </ul>
                
            </div>
            
</body>
</html>