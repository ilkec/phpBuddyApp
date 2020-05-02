<?php
include_once(__DIR__ .'../../classes/User.php');
include_once(__DIR__."/../classes/reaction.php");


if(!empty($_POST)){
$reactionId = json_decode($_POST['reaction']);

foreach($reactionId as $reaction){
  //var_dump($reaction->reactionId);
  
  $user = new User();
session_start();
$user->setEmail($_SESSION['user']);
  
$receiver = new User();
$receiver->setId($_SESSION['chatId']);


$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']);
$_SESSION['userid'] = $databaseId['id'];
  
  $r = new reaction();
  $r-> setMessageId($reaction->messageBoxId);
  $r-> setReactionId($reaction->reactionId);
  $r-> setUserId($databaseId['id']);
  
  $r->save();
  //var_dump($r);
echo $reaction->messageBoxId;
}
  
  
}
?>