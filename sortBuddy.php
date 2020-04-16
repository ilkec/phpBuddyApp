<?php
include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Db.php');

$user = new User();
session_start();

$user->setEmail($_SESSION['user']);
$connectedUserEmail = $_SESSION['user'];
$databaseId = $user->getDatabaseId();


/*------------------------------get-the-currently-logged-in-user-interest----------------------------------------------*/
$connectedUserFirstname = $user->getConnectedUserFirstname();
$user->setFirstname($connectedUserFirstname['firstname']);
$connectedUserlastname = $user->getConnectedUserLastname();
$user->setLastname($connectedUserlastname['lastname']);
$userFullname = $connectedUserFirstname['firstname'] . " " . $connectedUserlastname['lastname'];

$connectedUserPicture = $user->getConnectedUserPicture();
$user->setProfilePicture($connectedUserPicture['picture']);


$connectedUserGame = $user->getConnectedUserGame();
$user->setGames($connectedUserGame['games']);
$game = $connectedUserGame['games'];

$connectedUserBook = $user->getConnectedUserBook();
$user->setBooks($connectedUserBook['books']);
$book = $connectedUserBook['books'];

$connectedUserLocation = $user->getConnectedUserLocation();
$user->setLocation($connectedUserLocation['location']);
$location = $connectedUserLocation['location'];

$connectedUserMovie = $user->getConnectedUserMovie();
$user->setFilms($connectedUserMovie['films']);
$movie = $connectedUserMovie['films'];

$connectedUserMusic = $user->getConnectedUserMusic();
$user->setMusic($connectedUserMusic['music']);
$music = $connectedUserMusic['music'];

$connectedUserBuddyChoice = $user->getConnectedUserBuddyChoice();
$user->setBuddy($connectedUserBuddyChoice['buddy']);
$choice = $connectedUserBuddyChoice['buddy'];
/*------------------------------END----------------------------------------------*/

if (isset($_SESSION['user'])) {
  $conn = Db::getConnection();

  //$query = "select firstname from users where games = '$curentUserGame' and email != '$curntUserEmail'";
  $query= "select id, firstname, lastname, picture, books, films, games,music,location,buddy from users where email != '$connectedUserEmail' and films ='$movie'and music ='$music'and location ='$location'and games ='$game'and books ='$book' and buddy != '$choice'";

  $countUsers = $user->countUsers();
  $countMatches = count($user->showMatches());
}


if (!empty($_POST['btnTalk'])) {
  $idReceiver = $_POST['inputUserId'];
  $_SESSION['chatId'] = $idReceiver;
  $user->setFromUser($databaseId['id']);
  $user->setToUser($_SESSION['chatId']);
  $user->sendMatchRequest();
  $user->sendMatchMail();
  header("Location: feature8.php");
}

$redenfield = "";

if (isset($_POST['acceptBtn'])) {
  $user->acceptMatchRequest();
}

if (isset($_POST['deleteBtn'])) {
  $user->deleteMatchRequest();
  $redenfield = "<label for='Reden'>U kan hier de reden geven waarom u dit verzoek weigert.</label><br>
  <input type='text' id='reden' name='reden' size='51'>
  <button onclick='hide(); return false;' class='type-select btn btn-success' type='submit' name='redenBtn' id='redenBtn'>Submit</button>";
} else if (isset($_POST['redenBtn'])) {
  $user->setReden($_POST['reden']);
  $user->geefReden();
  $redenfield = "";
}

// var_dump($databaseId);
$user->setId($databaseId['id']);
$allMatches = $user->receiveMatchRequest();
// var_dump($allMatches);

$notification = count($user->newMessage());
//var_dump($notification);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
  <style>
    .countUsers {
      display: grid;
      grid-template-columns: 1fr 1fr;
    }

    #activeUsers {
      display: grid;
      grid-column: 1/2;
      background-color: #343a40;
      border-right: 1px solid white;
    }

    #countActiveUsers,
    #countActiveBuddies {
      text-align: center;
      color: white;
    }

    #activeBuddies {
      display: grid;
      grid-column: 2/3;
      background-color: #343a40;
    }

    #personIcon,
    #buddyIcon {
  
      margin: 10px auto 10px auto;

    }
  </style>
</head>

<body>
  <!-----------------------------Navbar------------------------------>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container-fluid"> <a class="navbar-brand" href="#"><img src="img/Logo.png" width="70em" alt="MyBuddyApp"></a>
      <ul class="nav justify-content-end"> <a class="nav-link profile" href="profile.php">
       
       <a href="messages.php">
         <div id="newMessage"><?php echo $notification ?></div> 
      </a>
       <img src="<?php if ($connectedUserPicture['picture'] === NULL) {
                                                                                                      echo "uploads/profilePic.png";
                                                                                                    } else {
                                                                                                      echo "uploads/" . $connectedUserPicture['picture'];
                                                                                                    } ?>" class="avatar"><?php echo $connectedUserFirstname['firstname'] . " " . $connectedUserlastname['lastname'] ?></a></ul>
    </div>
  </nav>

  <div class="container-fluid box ">
    <div class="countUsers">
      <div id="activeUsers">
        <img id="personIcon" src="img/user-icon.svg" alt="icon person">
        <p id="countActiveUsers"><?php echo " Active users: " . $countUsers['registeredUsers']; ?></p>
      </div>
      <div id="activeBuddies">
        <img id="buddyIcon" src="img/buddy-icon.svg" alt="icon person">
        <p id="countActiveBuddies"><?php echo "Buddies: " . $countMatches; ?></p>
      </div>
    </div>
    <?php foreach ($allMatches as $m) {
      // $user->setBuddy($m);
      // $user->setToUser($m);
      // $user->setBuddy($m['id']);
    ?>
      <form id="verzoek" action="" method="POST">
        <div>
          <h4>Je hebt een buddyverzoek ontvangen van <?php echo implode($m) ?></h4>
          <button onclick="hide(); return false;" class="type-select btn btn-secondary" type="submit" name="acceptBtn" id="acceptBtn">Accepteren</button>
          <button class="type-select btn btn-secondary" type="submit" name="deleteBtn" id="deleteBtn">Weigeren</button>
          <br>
        </div> 
          </form>
        <?php } ?>
      <?php echo "$redenfield" ?>
  
      <form class="form-inline userForm" method="post">
        <a href="" type="submit" name="bookBtn" id="book" class="interest">
          <div class="type-select btn btn-primary bookBtn"><i class="fas fa-book-open icon"></i>Book: <span class="badge badge-dark"><?php echo $connectedUserBook['books'] ?></span></div>
        </a>
        <a href="" id="movie" type="submit" name="movieBtn" class="interest">
          <div class="type-select btn btn-primary movieBtn"><i class="fas fa-film icon"></i>Movie: <span class="badge badge-dark"><?php echo $connectedUserMovie['films'] ?></span> </div>
        </a>
        <a href="" type="submit" name="musicBtn" id="music" class="interest">
          <div class="type-select btn btn-primary musicBtn"><i class="fas fa-music icon"></i>Music: <span class="badge badge-dark"><?php echo $connectedUserMusic['music'] ?></span></div>
        </a>
        <a href="" id="game" type="submit" name="gameBtn" class="interest">
          <div class="type-select btn btn-primary gameBtn"><i class="fas fa-gamepad icon"></i>Game: <span class="badge badge-dark"><?php echo $connectedUserGame['games'] ?></span></div>
        </a>
        <a href="" id="location" type="submit" name="locationBtn" class="interest">
          <div class="type-select btn btn-primary"><i class="fas fa-map-marker-alt icon"></i>Location: <span class="badge badge-dark"><?php echo $connectedUserLocation['location'] ?></span></div>
        </a>
        <a href="" id="all" type="submit" name="showAllBtn" class="interest">
          <div class="type-select btn btn-primary"><i class="fas fa-list icon"></i>Show all</div>
        </a>
      </form>
      <div class="container-list">
        <div class="userContainer">
          <ul class="usersList">
            
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
  <script>
    function hide() {
      document.getElementById("verzoek").style.display = "none";
    }
  </script>
</body>

</html>