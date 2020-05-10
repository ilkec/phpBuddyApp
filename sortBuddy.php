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
  $query = "select id, firstname, lastname, picture, books, films, games,music,location,buddy from users where email != '$connectedUserEmail' and films ='$movie'and music ='$music'and location ='$location'and games ='$game'and books ='$book' and buddy != '$choice'";

  $countUsers = $user->countUsers();
  $countMatches = count($user->showMatches());
}


if (!empty($_POST['btnTalk'])) {
  $idReceiver = $_POST['inputUserId'];
  $_SESSION['chatId'] = $idReceiver;
  $user->setFromUser($databaseId['id']);
  $user->setToUser($_SESSION['chatId']);
  $user->sendMatchRequest();
  //$user->sendMatchMail(); //dees heb ik terug aangezet

  header("Location: chat.php");
}


$user->setId($databaseId['id']);
$allMatches = $user->receiveMatchRequest();


$notification = count($user->newMessage());
if ($notification > 0) {
  $showNotification = $notification;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Buddyfixers</title>
  
</head>

<body>

  <!-----------------------------Navbar------------------------------>
  <?php include_once("navbar.php") ?>
  <div class="container-fluid box">

    <?php
    foreach ($allMatches as $m) {
      $user->setBuddy($m['user_id2']);
      /*
      if ($user->getId() == $m['user_id1']) {
        continue;
      } */
    ?>
      <form id="verzoek" action="" method="POST">
        <div>
          <h4>Je hebt een buddyverzoek ontvangen van <?php echo htmlspecialchars($m['firstname'] . " " . $m['lastname']) ?></h4>
          <button class="type-select btn btn-secondary" type="submit" name="acceptBtn" id="acceptBtn">Accepteren</button>
          <button class="type-select btn btn-secondary" type="submit" name="deleteBtn" id="deleteBtn">Weigeren</button>
        </div> <?php
                if (isset($_POST['acceptBtn'])) {
                  $user->setBuddy($m['user_id2']);
                  $user->acceptMatchRequest();
                  $user->checkBuddy();
                  echo "Verzoek geaccepteerd!";
                }
                if (isset($_POST['deleteBtn'])) {
                  $user->setBuddy($m['user_id2']);
                ?>
          <label for='Reden'>U kan hier de reden geven waarom u dit verzoek weigert.</label><br>
          <input type='text' id='reden' name='reden' size='51'>
          <button onclick='hide(); return false;' class='type-select btn btn-success' type='submit' name='redenBtn' id='redenBtn'>Submit</button>
          <?php // } 
          ?>
      <?php if (isset($_POST['redenBtn'])) {
                    $user->setBuddy($m['user_id2']);
                    $user->setReden($_POST['reden']);
                    $user->deleteMatchRequest();
                    $user->geefReden();
                    echo "Verzoek verwijderd!";
                  }
                }
              }
      ?>
      </form>
      <!------counters------>
      <div class="countUsers">
        <div id="activeUsers">
          <img class="counterIcon" id="personIcon" src="img/icon-user.svg" alt="icon person">
          <div id="countActiveUsers"><?php echo " Active: " . $countUsers['registeredUsers']; ?></div>
        </div>
        <div id="activeBuddies">
          <img class="counterIcon" id="buddyIcon" src="img/icon-buddy.svg" alt="icon person">
          <div id="countActiveBuddies"><?php echo "Buddies: " . $countMatches; ?></div>
        </div>
      </div>
      <a class="listBuddies" href="listBuddies.php"><i class="fas fa-list" aria-hidden="true"></i>List of buddies</a>
      <a class="searchClassroom" href="classRoomFinder.php"><i class="fas fa-search-location" aria-hidden="true"></i> Classroom finder</a>
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
        <a href="searchUser.php">
          <div class="type-select btn btn-primary"><i class="fas fa-search icon"></i></div>
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
<!--
<script>
  function hide() {
    document.getElementById("verzoek").style.display = "none";
  }
</script>
-->

</html>