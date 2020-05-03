<?php

include_once(__DIR__ . '/classes/User.php');

$user = new User();
session_start();
$user->setEmail($_SESSION['user']);
if (isset($_SESSION['user'])) {
$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']); //id van de ingelogde gebruiker
$chatNames = $user->chatNames();
//var_dump($chatNames);

$newMessages = $user->newMessage();
//var_dump($newMessages);





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

    <title>Messages</title>
    <style>
        form{
            margin: 10px auto;
            border: none;
            border-top:  2px solid #d37f79;
            border-radius: 0;
        }

        form:last-of-type{
            border-bottom:  2px solid #d37f79;

        }
        body{
            background-color: #132236;
        }
        .chatName, h1{
            color: #fff;
        }

        
    </style>
</head>
<body>
    <h1>Messenger</h1>
    <a href="sortBuddy.php">Home</a>
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
                    $showNotification = "nieuwe berichten";
                    
                }
            }
        }?>
    <form action="" method="post">
    <div class="chatName">
        <p><?php echo $printName;?></p>
        <?php if(isset($showNotification)) : ?>
        <p><?php echo $showNotification; ?></p>
        <?php unset($showNotification); endif;  ?>
    </div>
        <input type="hidden" id="inputUserId" name="inputUserId" value="<?php echo $printId; ?>">
        <input type="submit" value="Chat" class="btn btn-primary mb-3" id="btnChat" name="btnChat"> 
    </form>
    <?php }; ?>
</body>
</html>