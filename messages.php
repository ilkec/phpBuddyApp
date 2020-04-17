<?php

include_once(__DIR__ . '/classes/User.php');

$user = new User();
session_start();
$user->setEmail($_SESSION['user']);
$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']); //id van de ingelogde gebruiker


//zoek met welke personen je al een gesprek hebt gehad
//

$receiver = new User();
$receiver->setId(14);
$receiverInfo = $receiver->getAll();
var_dump($receiverInfo);

if (!empty($_POST['btnChat'])) {
    $idReceiver = $_POST['inputUserId'];
    $_SESSION['chatId'] = $idReceiver;
    $user->updateNotification();
    header("Location: feature8.php");
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
</head>
<body>
    <h1>Hier komen de messages</h1>
    
    <form action="" method="post">
    <div>
        <p><?php echo $receiverInfo['firstname'] . " " . $receiverInfo['lastname'];?></p>
    </div>
        <input type="hidden" id="inputUserId" name="inputUserId" value="<?php echo $receiverInfo['id']; ?>">
        <input type="submit" value="chatten" class="btn btn-primary mb-3" id="btnChat" name="btnChat"> 
    </form>
</body>
</html>