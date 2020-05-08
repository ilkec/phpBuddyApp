<?php

include_once(__DIR__ . '/classes/User.php');

$user = new User();
session_start();
$user->setEmail($_SESSION['user']);

if (isset($_SESSION['user'])) {
    $databaseId = $user->getDatabaseId();
    $user->setId($databaseId['id']); //id van de ingelogde gebruiker
    $chatNames = $user->chatNames();
    if(count($chatNames) === 0){
        $noChats = "There are no chats started yet";
    }
        
    $newMessages = $user->newMessage();

if (!empty($_POST['btnChat'])) {
    $idReceiver = $_POST['inputUserId'];
    $_SESSION['chatId'] = $idReceiver;
    $_SESSION['userid'] = $databaseId['id'];
    $user->setToUser($_SESSION['chatId']);
    $user->setFromUser($databaseId['id']);
    $user->updateNotification();
    header("Location: feature8.php");
  }

} else {
    header("Location: feature2.php");
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Messenger</title>
</head>
<body>
    <?php include_once("navbar.php") ?>
    
    <h2 class="h2-buddy">Messenger</h2>
    <?php if(isset($noChats)) : ?>
            <p class="emptyState"><?php echo $noChats;?></p>
            <?php endif; ?>
    <?php foreach($chatNames as $chatName) {
         if($chatName['user_id1'] === $databaseId['id']) {
            $printName = $chatName['user2'];
            $printId = $chatName['user_id2'];
        }
        else if($chatName['user_id2'] === $databaseId['id']) {
            $printName = $chatName['user1'];
            $printId = $chatName['user_id1'];
        } 
        if($newMessages > 0) {
            foreach($newMessages as $newMessage) {
                if ($newMessage['from_user'] === $printId){
                    $showNotification = "new messages";
                    
                }
            }
        }?>
    <form action="" method="post" class="form-chatnames">
    <div class="chatNames">
        <p class="chatname"><?php echo htmlspecialchars($printName);?></p>
        <?php if(isset($showNotification)) : ?>
        <p class="newMessages"><?php echo $showNotification; ?></p>
        <?php unset($showNotification); endif;  ?>
    </div>
        <input type="hidden" id="inputUserId" name="inputUserId" value="<?php echo $printId; ?>">
        <input type="submit" value="Chat" class="btn btn-primary mb-3" id="btnChat" name="btnChat"> 
    </form>
    <?php }; ?>
</body>
</html>