<?php

    include_once(__DIR__ . '/classes/User.php');
    include_once(__DIR__ . '/classes/Comment.php');
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

    //check if user is a moderator
    $isModerator = $user->getModerator();
    $isModerator = true;

    //fetch all comments
    $output = '';
    $dummyComment = new Comment();
    $output = $dummyComment->getAllComments($isModerator);

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
        if(isset($_POST['pin'])){
            $pinnedId = $_POST['pin'];
            $comment = new comment();
            $comment->setPinned($pinnedId);
        }
        else{
            $comment = new comment();
            $comment->setParent_Id($parentId);
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
                $output = $dummyComment->getAllComments($isModerator);
                $response = $error;
            }
            $response = $error;
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  
    <link rel="stylesheet" href="css/commentStyle.css">
    <title>Document</title>
</head>
<body>
    <h2>FAQ</h2>
    <div><?php echo $response; ?></div>
    <form action="" method="post">
        <!-- <label for="comment_name">Title:</label> -->
        <input class="title" type="text" id="comment_name" name="comment_name" placeholder="Place your title here">
        <br><br>
        <!--<label for="comment_content">Comment:</label>-->
        <input class="comment" type="textarea" id="comment_content" name="comment_content" placeholder="Place your comment here">
        <br><br>
        <input class="submit_btn" type="submit" value="Post Comment">
    </form>

    <?php foreach($output as $comment): ?>
    <div class="comments_display" id="comments_display">
        <p><?php echo $comment['comment_title'] ?></p>
        <?php echo $comment['comment'] ?>
        <a href="#" id="upvote">upvote</a>
    </div>
    <?php endforeach; ?>
    <script src="js/upvote.js"></script>
</body>
</html>