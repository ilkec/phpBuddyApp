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
    $user->setFirstname($userFirstName['firstname']);
    $user->setLastname($userLastName['lastname']);

    //fetch all comments
    $output = '';
    $dummyComment = new Comment();
    $output = $dummyComment->getAllComments();

    //add new comment
    $error = '';
    $response = '';
    $parentId = 0;
    if(!empty($_GET)){
        $parent = $_GET['parent'];
        $response = 'Replying to comment: ' . $parent;
        $parentId = $parent;
    }
    if(!empty($_POST)){
        $comment = new comment();
        $comment->setParent_Id($parentId);
        $test = $comment->getParent_id();
        var_dump($test);
        $comment->setSenderName($user->getFirstName() . ' ' .  $user->getLastName());
        if(empty($_POST['comment_name'])){
            $error = 'no comment title';
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
            $output = $dummyComment->getAllComments();
            $response = $error;
        }
        $response = $error;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/comment_style.css">
    <title>Document</title>
</head>
<body>
    <h2><?php echo $response; $error; ?></h2>
    <form action="" method="post">
        <!-- <label for="comment_name">Title:</label> -->
        <input class="title" type="text" id="comment_name" name="comment_name" placeholder="Place your title here">
        <br><br>
        <!--<label for="comment_content">Comment:</label>-->
        <input class="comment" type="textarea" id="comment_content" name="comment_content" placeholder="Place your comment here">
        <br><br>
        <input class="submit_btn" type="submit" value="Post Comment">
    </form>
    <div class="comments_display" id="comments_display">
        <?php echo $output; ?>
    </div>
</body>
</html>