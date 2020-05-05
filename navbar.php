<?php

$connectedUserPicture = $user->getConnectedUserPicture();
$user->setProfilePicture($connectedUserPicture['picture']);

$notification = count($user->newMessage());
if ($notification > 0) {
  $showNotification = $notification;
}




?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top main-menu sortbuddy">
    <div class="container sortBuddy">
      <ul class="nav justify-content-end"> 
       <a class="" id="profilImg" href="profile.php">
        <div class="ProfilAvatar">
       <img src="<?php if ($connectedUserPicture['picture'] === NULL) { echo"uploads/profilePic.png";} 
            else {echo "uploads/" . $connectedUserPicture['picture'];} ?>" class="">
        </div>
        </a>
      <a class="nav-link pt-4" href="feature22.php" id="contactIcon"><i class="fas fa-address-book"></i></a>
      <a id="messageNotification" class="nav-link pt-4" href="messages.php"><i class="fas fa-comment"></i>
       <?php if (isset($showNotification)) : ?>
            <div class="error"><?php echo $showNotification; ?></div>
          <?php endif; ?>
      </a>
       <a class="nav-link pt-4 comments " href="feature20.php"><i class="fas fa-sticky-note"></i></a>
       <a class="nav-link pt-4 settings" href="profileSettings.php"><i class="fas fa-cog"></i></a>
      </ul>
    </div>
  </nav>

  