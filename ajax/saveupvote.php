<?php

include_once(__DIR__ . "../../classes/Comment.php");

if(!empty($_POST)){
    
    session_start();
    //new comment
    $upvote = new Comment();
    $userid = $_SESSION['userid'];

    /*$upvote->upvoteUpdate($_POST['commentid']);
    $upvote->upvoteInsert($userid, $_POST['commentid']);*/
   /* var_dump($result);
    die();*/
    //succes teruggeven
    $response = [
        'status' => 'succes',
        'body' => htmlspecialchars("koekoek"),
        'message' => 'comment saved',
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}

?>
