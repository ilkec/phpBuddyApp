<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/phproject/classes/User.php');
    /*

    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }

    */
    //set current user
    $user = new User();
    $user->setFirstName("tester1");
    /*
    
    $user->setEmail($_SESSION['user']);
    $userId = $user->getCurrentUser();
    $user->setId($userId);
    
    */

    //add new comment + create error var for verification
    $error = '';
    if(!empty($_POST) && isset($_POST['update']) !== true){
        $comment_name = '';
        $comment_content = '';

        if(empty($_POST['comment_name'])){
            $error = 'no comment name';
        }else{
            $comment_name = $_POST['comment_name'];
        }
        if(empty($_POST['comment_content'])){
            $error = 'no comment content';
        }else{
            $comment_content = $_POST['comment_content'];
        }
        if($error == ''){
            $conn = new PDO('mysql:host=localhost;dbname=testing', 'root', '');
            $parentcomment_id = 0;
            $comment_sendername = $user->getFirstName();
            $comment = $comment_content;
            $statement = $conn->prepare("INSERT INTO tbl_comment (parentcomment_id, comment, comment_sendername) VALUES (:parentcomment_id, :comment, :comment_sendername);");
            $statement->bindValue(":parentcomment_id", $parentcomment_id);
            $statement->bindValue(":comment", $comment);
            $statement->bindValue(":comment_sendername", $comment_sendername);
            $result = $statement->execute();
            $error = 'Comment succesfully posted';
        }
    }
    //fetch all comments
    function fetchComments(){
        $conn = new PDO('mysql:host=localhost;dbname=testing', 'root', '');
        $statement = $conn->prepare("SELECT * FROM tbl_comment WHERE parentcomment_id = '0' ORDER BY comment_id DESC");
        $statement->execute();
        $result = $statement->fetchAll();
        $output = '';
        foreach($result as $row){
            $output .= '
                <div class="comment_container">
                    <div class="comment_header">' .$row["comment_sendername"]. '</div>
                    <div class="comment_body"> ' .$row["comment"]. ' </div>
                    <div class="comment_footer"><button type="button" id="'.$row["comment_id"].'">Reply</button></div>
                </div>
            ';
        }
        return $output;
    }
    $output = '';
    if(isset($_POST['update'])){
        $output = fetchComments();
        unset($_POST['update']);
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