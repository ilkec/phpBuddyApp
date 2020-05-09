<?php

include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Comment.php');
include_once(__DIR__ . '/classes/reaction.php');
include_once(__DIR__ . '/classes/showReaction.php');



$user = new User();
session_start();
$user->setEmail($_SESSION['user']);
if (isset($_SESSION['user'])) {
    $databaseId = $user->getDatabaseId();
    $user->setId($databaseId['id']);
    $_SESSION['userid'] = $databaseId['id'];
    //var_dump($databaseId['id']);
    $getAllUser = $user->getAll();
    //var_dump($getAllUser);
    $firstname = $getAllUser['firstname'];



    $receiver = new User();
    $receiver->setId($_SESSION['chatId']);
    $receiverInfo = $receiver->getAll();
    //var_dump($receiverInfo);




    $user->setToUser($_SESSION['chatId']);
    $user->setFromUser($databaseId['id']);
    $chatHistory = $user->messagesFromDatabase();
    //var_dump($chatHistory);

$user->setToUser($_SESSION['chatId']);
$user->setFromUser($databaseId['id']);
$chatHistory = $user->messagesFromDatabase();
//var_dump($chatHistory);


$allReactions = reaction::getAll($databaseId['id']);
$showemojis= showReaction::showReactions();
}else{
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
    <title>chatbox</title>
   
</head>

<body id="feature8">
    
    <div id="chatpartner" class="row"><a href="messages.php" class="col backBtn"><i class="fas fa-chevron-left"></i></a><h1 class="col reciverName"><?php echo "you are talking to " . htmlspecialchars($receiverInfo['firstname']); ?></h1></div>
    <div class="chatbox-wrapper">
        <div class="chatbox">
            <?php foreach ($chatHistory as $chatMessage): ?>
            <div class="messageContainer row"> 
                <div class="messageBox col-lg-6" id="<?php echo $chatMessage['id']?>" >
                    <strong class="names" ><?php echo htmlspecialchars($chatMessage['fromUser']) . ": "; ?></strong>
                    <p><?php echo htmlspecialchars($chatMessage['message']) ?></p>
                    
                        <span class="givedReactionBox" id=""><img alt="" class="_1ift _5m3a img gived" id="" 
                        src="<?php foreach($allReactions as $givedReaction){echo $givedReaction['src'];}?>"></span>
                  
                </div>
                <div class="reactionsBox col-lg-2" id="">
                    <a href="" class="reaction-box-icon" id="showReactionBtn" data-messageid="<?php echo $chatMessage['id']?>">
                    <i class="far fa-smile" aria-hidden="false"></i>
                    </a>
                </div>
                <div class="emojisBox" id="">
              <div role='listbox' aria-orientation='horizontal' class='_1z8q _fy2'>
               <?php foreach($showemojis as $emojis):?>
               <span class='iconn'><img id='<?php echo $emojis['id']?>' alt='<?php echo $emojis['name']?>' class='_1ift _5m3a img' src='<?php echo $emojis['src']?>'></span>
               <?php endforeach;?>
               </div>
               
             </div>
            </div>
            <?php endforeach; ?>
        </div>
      

            <div class="mt-2">
                <input type="text" placeholder="message" name="message" id="message">
                <a href="#" class="btn btn-primary mb-3 btnSendMessages" id="btnSendMessage" name="sendMessage" data-sendername="<?php echo $getAllUser['firstname'] . ": "; ?>">Send message</a>
            </div>
        </div>


   
    <script src="https://kit.fontawesome.com/6792ce1460.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/app.js"></script>
   
</body>

</html>