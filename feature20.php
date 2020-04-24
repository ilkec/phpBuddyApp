<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/phpbuddyapp2/phpbuddyapp/classes/User.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/phpbuddyapp2/phpbuddyapp/classes/comment.php');
    $user = new User();
    session_start();
    $databaseId = $user->getDatabaseId();
    $user->setId($databaseId);

    if (!isset($_SESSION['user'])) {
        header("Location: feature2.php");
    }else{
        $user->setEmail($_SESSION['user']);
    }
    $userFirstName = $user->getConnectedUserFirstname();
    $userLastName = $user->getConnectedUserLastname();
    $user->setFirstname($userFirstName);
    $user->setLastname($userLastName);

    //add new comment + create error var for verification
    $error = '';
    if(!empty($_POST) && isset($_POST['update']) !== true){
        $comment = new comment();
        $comment->setParent_Id(0);
        $comment->setSenderName($user->getFirstName());
        $test = $comment->getSenderName();
        if(empty($_POST['comment_name'])){
            $error = 'no comment name';
        }else{
            $comment->setTitle($_POST['comment_name']);
        }
        if(empty($_POST['comment_content'])){
            $error = 'no comment content';
        }else{
            $comment->setComment($_POST['comment_content']);
        }
        if($error == ''){
            $comment->addComment();
            $error = 'Comment succesfully posted';
        }
    }
    //fetch all comments
    $output = '';
    if(isset($_POST['update'])){
        $comment = new Comment();
        $output = $comment->getAllComments();
        unset($_POST['update']);
        $test = $comment->test();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><?php echo $error; ?></h2>
    <form action="" method="post">
        <label for="comment_name">Title:</label>
        <input type="text" id="comment_name" name="comment_name">
        <br><br>
        <label for="comment_content">Comment:</label>
        <input type="textarea" id="comment_content" name="comment_content">
        <br><br>
        <input type="submit" value="Post Comment">
    </form>
    <form action="" method="post">
        <input type="hidden" name="update">
        <input type="submit" value="update form">
    </form>
    <div id="comments_display">
        <?php echo $output; ?>
    </div>
</body>
</html>