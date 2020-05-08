<?php
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/classrooms.php");

$user = new User();
session_start();

$user->setEmail($_SESSION['user']);
$connectedUserEmail = $_SESSION['user'];
$databaseId = $user->getDatabaseId();


if (isset($_SESSION['user'])) {
    $matches = $user->showMatches();
} else {
    header("Location: feature2.php");
}


$showAllClassRoom = classrooms::searchClassRoom('');
  if(isset($_POST['search'])){
    $showAllClassRoom = classrooms::searchClassRoom($_POST['searchCampus']);
  }
  


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>
<body>
 <?php include_once("navbar.php")?>
 
 <div class="contain" >
 <form action="" id="searchBalkLocal" method="post">
 <div class="input-group mb-3 localSeacr">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Campus</label>
  </div>
  <input type="text" name="searchCampus">
  <div class="input-group-append">
    <button class="btn btn-secondary" type="submit" name="search">search</button>
  </div>
</div>
</form>
 <div class="contain-box">
<?php foreach($showAllClassRoom as $classrooms):?>

  <div class="box">
    <div class="imgBox">
      <img src="<?php echo $classrooms['img']?>" alt="">
    </div>
    <div class="details" >
      <div class="content">
      <h2><?php echo $classrooms['campus']?></h2>
     
      <ul>
        <li><span>Classroom:</span> <?php echo $classrooms['classroom']?></li>
        <li><span>Floor: </span> <?php echo $classrooms['floor']?></li>
        <li><span>Adres:</span> <?php echo $classrooms['adres']?></li>
      </ul>
      </div>
    </div>
  </div>

<?php endforeach;?>
  
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>