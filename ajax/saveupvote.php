<?php

include_once(__DIR__ . "../../classes/Post.php");

if(!empty($_POST)){
    
    session_start();
    //new comment
    $upvote = new Post();
    $userid = $_SESSION['userid'];
    $commentid = $_POST['commentid'];
    $upvotecount = $_POST['upvotecount'];
    $upvote->upvoteUpdate($commentid, $upvotecount);
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
