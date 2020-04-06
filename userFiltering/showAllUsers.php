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
$connectedUserGame = $user->getConnectedUserGame();
$user->setGames($connectedUserGame['games']);
$game = $connectedUserGame['games'];
$connectedUserLocation = $user->getConnectedUserLocation();
$user->setLocation($connectedUserLocation['location']);
$location =$connectedUserLocation['location'];
$connectedUserMovie = $user->getConnectedUserMovie();
$user->setFilms($connectedUserMovie['films']);
$movie = $connectedUserMovie['films'];
$connectedUserMusic = $user->getConnectedUserMusic();
$user->setMusic($connectedUserMusic['music']);
$music = $connectedUserMusic['music'];


 $conn = Db::getConnection();

$query= "select id, firstname, lastname, picture, books, films, games,music,location from users where email != '$connectedUserEmail' and films ='$movie'and music ='$music'and location ='$location'and games ='$game'and books ='$book'";

  foreach($conn->query($query) as $data){
    if($movie == $data['films'] && $music == $data['music']&& $location == $data['location'] && $book == $data['books']&& $game == $data['games']){
       echo "</li>";

 echo "<li class='row'>";
 if($data['picture'] === NULL){
     echo "<img src='uploads/profilePic.png' class='avatar'>";
  }
  else{
     echo "<img src='uploads/".$data['picture']."' class='avatar'>";
  }
  echo "<h2 class='user-name col-xs-5' style='margin-right:45px' >".$data['firstname']." ".$data['lastname']."</h2>";
   echo "<h2 class='user-name col-xs-5'>Match 100%</h2>";
      echo "<form action='' method='post' style='border:none; margin:0; padding:0; width:0;' >";

        echo "<input type='hidden' id='inputUserId' name='inputUserId' value='".$data['id']."'>";
            echo "<input type='submit' value='Babbeltje doen?' class='btn btn-primary mb-3' id='btnTalk' name='btnTalk'> ";
  echo"</form>";
echo "</li>";
      
    }
   }