<?php

include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Comment.php');



$user = new User();
session_start();
$user->setEmail($_SESSION['user']);

$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']);
$_SESSION['userid'] = $databaseId['id'];
//var_dump($databaseId['id']);
$getAllUser = $user->getAll();

$firstname = $getAllUser['firstname'];

//$idReceiver = 14;

$receiver = new User();
$receiver->setId($_SESSION['chatId']);
$receiverInfo = $receiver->getAll();
//var_dump($receiverInfo);
/*if (!empty($_POST['sendMessage'])) {
    $message = $_POST['message']; //message moet later naar databank gestuurd worden met id van sender en id van receiver
    $user->setMessage($message);
    $user->setToUser($_SESSION['chatId']);
    $user->setFromUser($databaseId['id']);
    $user->setTime(date("Y-m-d H:i:s"));
    //var_dump($message);
    $user->sendMessage();
    
}*/
//// 1. kijken wie de ingelogde gebruiker is, dit wordt de zender van het bericht (getAllUser['firstname']);
//// 2. kijken wie de persoon in de buddysuggestie was, dit wordt de ontvanger van het bericht. (om te testen hardcoded in code zetten)
//// 3. als er gesubmit wordt bericht van zender ophalen uit textarea (input) en setten in setMessage();
//// 4. als er gesubmit wordt bericht sturen naar databank met id van zender en id van ontvanger. 
//// 5. berichten uit de databank halen waar het id van de user bij staat. deze berichten tonen in de 'chatbox'




$user->setToUser($_SESSION['chatId']);
$user->setFromUser($databaseId['id']);
$chatHistory = $user->messagesFromDatabase();
//var_dump($chatHistory);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .chatbox {
            height: 500px;
            width: 460px;
            padding: 20px;
            background-color: mintcream;
            overflow: auto;
        }

        #chatpartner {
            background-color: linen;
            width: 460px;
            padding: 20px;
        }

        #message {
            width: 400px;

        }

        .btn {
            background-color: #f29f90;
            color: white;
            text-decoration: none;
            text-align: center;
            padding: 5px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <a href="messages.php">Back</a>
    <div id="chatpartner"><?php echo "you are talking to " . $receiverInfo['firstname']; ?></div>
    <div class="chatbox">
        <?php foreach ($chatHistory as $chatMessage) : ?>
            <p><strong><?php echo $chatMessage['fromUser'] . ": "; ?></strong><?php echo $chatMessage['message'] ?></p>
        <?php endforeach; ?>
    </div>
    <!--<form class="container w-25 border border-primary rounded" action="" method="post" enctype="multipart/form-data">-->

        <div class="mt-2">
            <input type="text" placeholder="message" name="message" id="message">
            <a href="#" class="btn btn-primary mb-3" id="btnSendMessage" name="sendMessage">Send message</a>
        </div>



   <!-- </form>-->

    <script src="js/app.js"></script>
</body>

</html>