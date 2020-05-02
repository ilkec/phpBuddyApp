<?php

include_once(__DIR__ . "../../classes/Comment.php");

if(!empty($_POST)){
    
    session_start();
    //new comment
    $upvote = new Comment();
    $userid = $_SESSION['userid'];
    $commentid = $_POST['commentid'];
    $upvote->upvoteUpdate($commentid);
    $upvote->upvoteInsert($userid, $commentid);

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
