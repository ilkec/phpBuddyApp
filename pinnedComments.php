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

    $dummyContent = new Comment();
    $output = $dummyContent->getAllPinned();
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
    <?php echo $output; ?>
</body>
</html>