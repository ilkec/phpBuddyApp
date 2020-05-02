<?php
include_once(__DIR__ .'../../classes/User.php');
include_once(__DIR__ . '../../classes/Db.php');

$user = new User();
session_start();
$user->setEmail($_SESSION['user']);
$connectedUserEmail= $_SESSION['user'];


 $conn = Db::getConnection();
 $query = "select id, name, src from reaction";



echo "<div role='listbox' aria-orientation='horizontal' class='_1z8q _fy2'>";
foreach($conn->query($query) as $data){
echo "<span class='iconn'><img id='".$data['id']."' alt='".$data['name']."' class='_1ift _5m3a img' src='".$data['src']."'></span>";  
}
echo "</div>";


