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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>chatbox</title>
    <style>
        .chatbox {
            height: 500px;
            width: 600px;
            padding: 20px;
            background-color: mintcream;
            overflow: auto;
        }

        #chatpartner {
            background-color: linen;
            width: 600px;
            padding: 20px;
        }

        #message {
            width: 550px;
            height: 30px;

        }

        .btn {
            background-color: #f29f90;
            color: white;
            text-decoration: none;
            text-align: center;
            padding: 5px;
            font-size: 12px;
        }
        /*.names{
            display: inline;
        }*/
        
    </style>
</head>

<body>
    <a href="messages.php">Back</a>
    <div id="chatpartner"><?php echo "you are talking to " . $receiverInfo['firstname']; ?></div>
    <div class="chatbox">
        <?php foreach ($chatHistory as $chatMessage): ?>
            <p><strong class="names" ><?php echo $chatMessage['fromUser'] . ": "; ?></strong><?php echo $chatMessage['message'] ?></p>
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