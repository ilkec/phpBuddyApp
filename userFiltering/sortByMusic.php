<?php

include_once(__DIR__ .'../../classes/User.php');
include_once(__DIR__ . '../../classes/Db.php');

$user = new User();
session_start();
$user->setEmail($_SESSION['user']);
$connectedUserEmail= $_SESSION['user'];




$connectedUserMusic = $user->getConnectedUserMusic();
$user->setMusic($connectedUserMusic['music']);
$music = $connectedUserMusic['music'];
$conn = Db::getConnection();
 $statement = $conn->prepare("select firstname, lastname,picture,music from users where music = :music and  email != :connectedUserEmail");
  
$statement->bindValue(":connectedUserEmail",$connectedUserEmail);
$statement->bindValue(":music",$music);
$result = $statement->execute();



foreach($statement as $data){
  echo "<li class='row'>";
  if($data['picture'] === NULL){
     echo "<img src='uploads/profilePic.png' class='avatar'>";
  }
  else{
      echo "<div class='ProfilAvatarUserList'><img src='uploads/".$data['picture']."'></div>";
  }
  echo "<h2 class='user-name col-xs-5'>".$data['firstname']." ".$data['lastname']."</h2>";
echo "</li>";}

return $statement->fetchAll(PDO::FETCH_ASSOC);


