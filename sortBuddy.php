<?php 
include_once(__DIR__ .'/classes/User.php');
include_once(__DIR__ . '/classes/Db.php');

$user = new User();
session_start();

$user->setEmail($_SESSION['user']);
$connectedUserEmail= $_SESSION['user'];

/*------------------------------get-the-currently-logged-in-user-interest----------------------------------------------*/
$connectedUserFirstname = $user->getConnectedUserFirstname();
$user->setFirstname($connectedUserFirstname['firstname']);
$connectedUserlastname = $user->getConnectedUserLastname();
$user->setLastname($connectedUserlastname['lastname']);
$userFullname =$connectedUserFirstname['firstname']." ". $connectedUserlastname['lastname'];
$connectedUserPicture = $user->getConnectedUserPicture();
$user->setProfilePicture($connectedUserPicture['picture']);



if( isset($_SESSION['user']) ) {
  $conn = Db::getConnection();

  //$query = "select firstname from users where games = '$curentUserGame' and email != '$curntUserEmail'";
  $query = "select firstname, lastname,picture from users where email != '$connectedUserEmail'";
  
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
    <!-----------------------------Navbar------------------------------>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <div class="container-fluid"> <a class="navbar-brand" href="#">MyBuddyApp</a>
        <ul class="nav justify-content-end"> <a class="nav-link" href=""><img src="<?php if($connectedUserPicture['picture'] === NULL){ echo "uploads/profilePic.png";}else{
  echo "uploads/".$connectedUserPicture['picture'];} ?>" class="avatar"><?php echo $connectedUserFirstname['firstname']." ".$connectedUserlastname['lastname']?></a></ul>
      </div>
    </nav>
    <div class="container-fluid box ">
      <form class="form-inline userForm"  method="post" >   
        <a href="" type="submit" name="bookBtn" id="book">
          <div class="type-select btn btn-primary bookBtn"><i class="fas fa-book-open icon"></i>Book: <span class="badge badge-dark"></span></div>
        </a>
        <a href="" id="movie" type="submit" name="movieBtn" data-sortBy="movie">
          <div class="type-select btn btn-primary movieBtn" data-value="user"><i class="fas fa-film icon"></i>Movie: <span class="badge badge-dark"></span> </div>
        </a>
        <a href="" type="submit" name="musicBtn" id="music">
          <div class="type-select btn btn-primary musicBtn"><i class="fas fa-music icon"></i>Music: <span class="badge badge-dark"></span></div>
        </a>
        <a href="" id="game" type="submit" name="gameBtn">
          <div class="type-select btn btn-primary gameBtn" data-value="3"><i class="fas fa-gamepad icon"></i>Game: <span class="badge badge-dark"></span></div>
        </a>
        <a href="" id="location" type="submit" name="locationBtn" data-sortBy="location">
          <div class="type-select btn btn-primary" data-value="organization"><i class="fas fa-map-marker-alt icon"></i>Location: <span class="badge badge-dark"></span></div>
        </a>
        <a href="" id="all" type="submit" name="showAllBtn" data-sortBy="showAllBtn">
          <div class="type-select btn btn-primary"><i class="fas fa-list icon"></i>Show all</div>
        </a>
      </form>
      <div class="container-list">
        <div class="userContainer">
          <ul class="usersList">
             <?php foreach($conn->query($query) as $data): ?>
            <li class="row"> <img src="<?php if($data['picture'] === NULL){
  echo "uploads/profilePic.png ";
} else{
  echo "uploads/".$data['picture'];} ?>" class="avatar">
              <h2 class="user-name col-xs-5"><?php echo $data['firstname']." ".$data['lastname']?></h2> </li>
             <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <div id="#displayData"></div>
    <script src="https://kit.fontawesome.com/6792ce1460.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </body>

</html>