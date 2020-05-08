<?php
include_once(__DIR__ .'../../classes/User.php');
include_once(__DIR__ . '../../classes/Db.php');
class classrooms{
  
public static function searchClassRoom($searchText){
$conn = Db::getConnection();
 $statement = $conn->prepare("SELECT * FROM locals where campus  LIKE :campus or classroom  LIKE :classroom or adres LIKE :adres");
 $statement->bindValue(":campus","%".$searchText."%");
  $statement->bindValue(":classroom","%".$searchText."%");
   $statement->bindValue(":adres","%".$searchText."%");
  $result = $statement->execute();
  
  $data =  $statement->fetchAll(PDO::FETCH_ASSOC);
 
  return $data;

  } 
}