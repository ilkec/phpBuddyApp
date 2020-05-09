<?php


$connectedUserEmail = $_SESSION['user'];
$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']);

$connectedUserPicture = $user->getConnectedUserPicture();
$user->setProfilePicture($connectedUserPicture['picture']);

$notification = count($user->newMessage());
if ($notification > 0) {
  $showNotification = $notification;
}




?>


<nav class="navbar navbar-expand-md navbar-dark fixed-top main-menu sortbuddy">
   
<ul class="tab-bar">
  <li data-num="2" class="tab wave dark"><a href="feature22.php"><i class="fas fa-address-book"></i></a></li>
  <li data-num="3" class="tab wave dark"><?php if (isset($showNotification)) : ?>
  <div class="errorNotification"><?php echo $showNotification; ?></div><?php endif; ?>
  <a href="messages.php"><i class="fas fa-comment"></i></a>
  
  </li>
  <li data-num="2" class="tab wave dark avatar">
    <a href="profile.php"><div class="ProfilAvatar">
       <img src="<?php if ($connectedUserPicture['picture'] === NULL) { echo"uploads/profilePic.png";} 
            else {echo "uploads/".$connectedUserPicture['picture'];} ?>" class="">
        </div></a>
    
  </li>
  <li data-num="4" class="tab wave dark"><a href="feature20.php"><i class="fas fa-sticky-note"></i></a></li>
  <li data-num="5" class="tab wave dark"><a href="sortBuddy.php"><i class="fas fa-home"></i></a></li>
  <div class="indicator"></div>
</ul>
  
  </nav>
  <script src="https://kit.fontawesome.com/6792ce1460.js" crossorigin="anonymous"></script>
