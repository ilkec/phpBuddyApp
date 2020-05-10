<?php

    include_once(__DIR__ . '/classes/User.php');
    include_once(__DIR__ . '/classes/Comment.php');
    include_once(__DIR__ . '/classes/Post.php');
    
    $user = new User();
    session_start();
    $user->setEmail($_SESSION['user']);
    $databaseId = $user->getDatabaseId();
    $user->setId($databaseId['id']);
   
    $comment = new comment();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }else{
        $user->setEmail($_SESSION['user']);
        $_SESSION['userid'] = $databaseId['id'];
    }
    $userFirstName  = $user->getConnectedUserFirstname();
    $userLastName   = $user->getConnectedUserLastname();
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
    if (!empty($_GET)) {
        $parent = $_GET['parent'];
        $response = 'Replying to comment: ' . $parent;
        $parentId = $parent;
    }
    if (!empty($_POST)) {
        if (isset($_POST['pin'])) {
            $pinnedId = $_POST['pin'];
            $comment = new comment();
            $comment->setPinned($pinnedId);
        }
        else{
            
            $comment->setParent_Id($parentId);
            $comment->setSenderName($user->getFirstName() . ' ' .  $user->getLastName());
            
            if (empty($_POST['comment_name'])) {
                $error      = 'no comment title';
            }else{
                $comment->setTitle($_POST['comment_name']);
            }
            if (empty($_POST['comment_content'])) {
                $error      = 'no comment content';
            }else{
                $comment->setComment($_POST['comment_content']);
            }
            if ($error == '') {
                $comment->addComment();
                $error      = 'Comment succesfully posted';
                $output     = $dummyComment->getAllComments($isModerator);
                $response   = $error;
            }
            $response = $error;
        } //var_dump($output);
    }      
            $post = new Post();
            $post->setId($databaseId['id']);
            $oneUpvote = $post->getUpvoter();
            
            //var_dump($output);

        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/commentStyle.css">
    <title>FAQ</title>
</head>
<body>
    <h2><?php echo htmlspecialchars($response) ; ?></h2>                        
    <a class="home" href="sortBuddy.php">Home</a>
    <form action="" method="post">
        <!-- <label for="comment_name">Title:</label> -->
        <input  class="title"       type="text"     id="comment_name"       name="comment_name" placeholder="Place your title here">
        <br><br>
        <!--<label for="comment_content">Comment:</label>-->
        <input  class="comment"     type="textarea" id="comment_content"    name="comment_content" placeholder="Place your comment here">
        <br><br>
        <input  class="submit_btn"  type="submit" value="Post Comment">
        <a class="pinned_btn" href="pinnedComments.php">Pinned Messages</a>
    </form>
    <div class="comments_display" id="comments_display">
        <?php foreach($output as $row): ?>
            <div class="comment_container">
                <?php if($isModerator): ?>
                    <form action="" method="POST">
                        <input type="hidden" name="pin" value="<?php echo htmlspecialchars($row["id"])  ?>">   
                        <input class="pin_btn" type="submit" value="Pin">
                    </form>
                <?php endif; ?>
                <div class="comment_header"> 
                <p> <h3><?php echo htmlspecialchars($row["comment_title"]) ; ?></h3> </p> 
                    <h5 id="koekoek"> <?php echo htmlspecialchars($row["comment_sender_name"]) ; ?></h5>        
                </div>
                <p class="date"><?php echo htmlspecialchars($row["date"] ) ?></p>                                           
                <div class="comment_body"> 
                                      
                    <p><?php echo htmlspecialchars($row["comment"]) ;?></p>                                      

                    <?php foreach($oneUpvote as $upvoteForId){ 
                        if ($upvoteForId['comment_id'] ===  $row["id"]) {
                            $errorUpvote = "You already upvoted";
                        } else {
                            $setUpvoteBtn = "upvote";
                        }
                    }?>

                    <div class="upvoteclass">
                        <p id="upvoteCount"><?php echo $row['upvote_count']; ?></p>
                        <?php if (isset($errorUpvote)) { ?>
                            <p><?php echo $errorUpvote ;?></p>
                        <?php unset($errorUpvote);}
                         else {?>
                            <a href="#" id="upvote" data-commentid="<?php echo $row['id'];?>" data-number="<?php echo $row['upvote_count'];?>"><?php echo $setUpvoteBtn; ?></a> 
                         <?php unset($setUpvoteBtn); } ?>

                        
                    </div>
                </div>
                <div class="comment_footer"><form action="" method="GET">
                    <input type="hidden" name="parent" value="<?php echo htmlspecialchars($row["id"])  ?>">                       
                    <input class="reply_btn" type="submit" id="<?php echo htmlspecialchars($row["id"])  ?>" value="Reply">          
                </form></div>
            </div>
            <?php
                $thisComment = new comment();
                $thisComment->setId($row["id"]);
                $thisId = $thisComment->getId();
                $replies = $thisComment->getReplies($thisId);
            ?>
            <?php foreach($replies as $row): ?>
                <div class="reply_container" > 
                    <?php if($isModerator): ?>
                        <form action="" method="POST">
                            <input type="hidden" name="pin" value="<?php echo htmlspecialchars($row["id"]) ; ?>">   
                            <input class="pin_btn" type="submit" value="Pin">
                            
                        </form>
                    <?php endif; ?>
                    <div class="comment_header">
                    <p> <h3><?php echo htmlspecialchars($row["comment_title"]) ; ?> </h3> </p>    
                    <h5><?php echo htmlspecialchars($row["comment_sender_name"]) ; ?></h5> </div> 
                    <p class="date"><?php echo $row["date"]; ?></p> 
                    <div class="comment_body"> 
                        
                        <p><?php echo htmlspecialchars($row["comment"]) ; ?> </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?> 
    </div>

    

    <script src="js/upvote.js"></script>
</body>
</html>