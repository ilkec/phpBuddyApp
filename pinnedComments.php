<?php
    /*include_once($_SERVER['DOCUMENT_ROOT'] . '/phpbuddyapp2/phpbuddyapp/classes/User.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/phpbuddyapp2/phpbuddyapp/classes/comment.php');*/

    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Comment.php");

    $user = new User();
    session_start();
    $databaseId = $user->getDatabaseId();
    $user->setId($databaseId);

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }else{
        $user->setEmail($_SESSION['user']);
    }

    $dummyContent = new Comment();
    $output = $dummyContent->getAllPinned();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/commentStyle.css">
    <title>Document</title>
</head>

<body>
    <div><a class="pinn_btn" href="faq.php">Go back to comments</a></div>
    <?php foreach($output as $row): ?>

    <div class="comment_container">

        <div class="comment_header">
            <h3><?php echo htmlspecialchars($row["comment_sender_name"]) ; ?></h3>
        </div>
        <p><?php echo $row["date"]; ?></p>
        <div class="comment_body">
            <p>
                <h5><?php echo htmlspecialchars($row["comment_title"]) ; ?></h5>
            </p>
            <p><?php echo htmlspecialchars($row["comment"]) ; ?></p>
        </div>
        <div class="comment_footer">
            <form action="" method="GET">
                <input type="hidden" name="parent" value="<?php echo htmlspecialchars($row["id"]) ; ?>">
                <input class="reply_btn" type="submit" id="<?php echo htmlspecialchars($row["id"]) ; ?>" value="Reply">
            </form>
        </div>

    </div>
    <?php endforeach; ?>
</body>

</html>