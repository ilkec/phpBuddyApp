<?php

include_once(__DIR__ .'../../classes/User.php');
include_once(__DIR__ . '../../classes/Db.php');

$user = new User();
session_start();
$user->setEmail($_SESSION['user']);
$connectedUserEmail= $_SESSION['user'];


$connectedUserBook = $user->getConnectedUserBook();
$user->setBooks($connectedUserBook['books']);
$book = $connectedUserBook['books'];
 $conn = Db::getConnection();

$query = "select firstname, lastname,picture from users where  books = '$book' and  email != '$connectedUserEmail'";
//var_dump($data);


foreach($conn->query($query) as $data){
  echo "<li class='row'>";
  if($data['picture'] === NULL){
     echo "<img src='uploads/profilePic.png' class='avatar'>";
  }
  else{
     echo "<img src='uploads/".$data['picture']."' class='avatar'>";
  }
  echo "<h2 class='user-name col-xs-5'>".$data['firstname']." ".$data['lastname']."</h2>";
 
echo "</li>";
  
}