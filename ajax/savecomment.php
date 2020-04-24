<?php

include_once(__DIR__ . "../../classes/Comment.php");

if(!empty($_POST)){
    
    session_start();
    //new comment
    $c = new Comment();
    $c->setReceiver($_SESSION['chatId']);
    
    $c->setMessage($_POST['text']);
    $c->setFrom($_SESSION['userid']); //normaal via $_SESSION
    $c->setDatetime(date("Y-m-d H:i:s"));
    //save()

    $c->sendToDatabase();
   /* var_dump($result);
    die();*/
    //succes teruggeven
    $response = [
        'status' => 'succes',
        'body' => htmlspecialchars($c->getMessage()),
        'message' => 'comment saved',
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}

?>