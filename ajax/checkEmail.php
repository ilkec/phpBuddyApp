
<?php

include_once(__DIR__ .'../../classes/User.php');
include_once(__DIR__ . '../../classes/Db.php');

$uEmail = json_decode($_POST['usrEmail']);




foreach($uEmail as $email){
  $givedEmail = $email->userGivedEmail;
  $conn = Db::getConnection();
  $statement = $conn->prepare("select email from users where  email = :email");
  $statement->bindValue(":email",$givedEmail);
  
  $statement->execute();

  
if ( $statement->rowCount() > 0){
   echo '<p class= emailExisitError >This email already exists</p>';
  
}else{
  echo '<p  class= sucessEmail >Email is avalaible</p>';
  
}
  
}
