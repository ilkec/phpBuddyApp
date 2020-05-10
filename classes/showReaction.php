<?php
include_once(__DIR__ .'../../classes/User.php');
include_once(__DIR__ . '../../classes/Db.php');
class ShowReaction{
  
/*
$user = new User();
session_start();
$user->setEmail($_SESSION['user']);
$connectedUserEmail= $_SESSION['user'];

*/
 


public static function showReactions()
{
    $conn = Db::getConnection();
    $statement = $conn->prepare("select id, name, src from reaction");
    $result = $statement->execute();

 return $statement->fetchAll(PDO::FETCH_ASSOC);

  }

}