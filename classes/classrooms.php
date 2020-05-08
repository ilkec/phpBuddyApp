<?php
include_once(__DIR__ .'../../classes/User.php');
include_once(__DIR__ . '../../classes/Db.php');
class classrooms{
  
public static function searchClassRoom($searchText){
$conn = Db::getConnection();
 $statement = $conn->prepare("SELECT * FROM classrooms where campus  LIKE :campus or classroom  LIKE :classroom or adres LIKE :adres");
 $statement->bindValue(":campus","%".$searchText."%");
  $statement->bindValue(":classroom","%".$searchText."%");
   $statement->bindValue(":adres","%".$searchText."%");
  $result = $statement->execute();
  
  $data =  $statement->fetchAll(PDO::FETCH_ASSOC);
 if(empty($data)){
    echo "<div class='alert alert-warning' role='alert' style= 'text-align: center; display: block;'>No classroom or campus found! try a valid campus name or classroom </div>";
  }
  
  
  return $data;

  } 
}