<?php

include_once(__DIR__ .'../../classes/User.php');
include_once(__DIR__ .'../../classes/Db.php');
$user = new User();
session_start();
$user->setEmail($_SESSION['user']);
$connectedUserEmail= $_SESSION['user'];
$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']);
$connectedUserId = $databaseId['id'];
$getAllUser = $user->getAll();
//var_dump($connectedUserGame['games']);
$reactionId = json_decode($_POST['reaction']);






  
  foreach($reactionId as $reaction){
    $messageId = $reaction->messageBoxId;
    $userReaction = $reaction->reactionId;
    $conn = Db::getConnection();
    $query = "SELECT message_reactions.msg_id,reaction.src,message_reactions.usr_id FROM message_reactions INNER JOIN messages ON messages.id = $messageId JOIN reaction ON reaction.id = $userReaction  JOIN users ON users.id = $connectedUserId";
    
   // $query ="SELECT message_reactions.msg_id,reaction.src,message_reactions.usr_id FROM message_reactions INNER JOIN messages ON messages.id = message_reactions.msg_id JOIN reaction ON reaction.id = message_reactions.reaction_id  JOIN users ON users.id = 24";
    
   
foreach($conn->query($query) as $data){
    echo  $data['src'];
return $data['src'];
  
}
  }
 