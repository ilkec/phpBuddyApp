<?php

include_once(__DIR__ . '/classes/User.php');

$user = new User();

session_start();
$user->setEmail($_SESSION['user']);
$databaseId = $user->getDatabaseId();
//var_dump($databaseId);
$user->setId($databaseId['id']);
//var_dump($databaseId['id']);


if (isset($_SESSION['user'])) {
    $getAllUser = $user->getAll();
    //var_dump($getAllUser);
} else {
    header("Location: feature2.php");
}

if (isset($_POST['return'])) {
    session_start();
    session_unset();
    session_destroy();

    header("Location: feature2.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<style>
    .profilePicture {
        width: 150px;
    }

    #settingsIcon {
        width: 40px;
       
    }
</style>

<body>
    <img src="img/chairs.jpg" alt="chairs" id="profile-bg">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid"> <a class="navbar-brand" href="feature7.php"><img src="img/Logo.png" width="70em" alt="MyBuddyApp"></a>
        </div>
    </nav>
    <section class="container-fluid">
        <div class="col-lg-6 col-md-6 profile-form">
            <h2>Profiel</h2>
            <a href="profileSettings.php"><img src="img/settings_icon.png" alt="settingsIcon" id="settingsIcon"></a>
            <div>
                <img src="<?php if ($getAllUser['picture'] === NULL) {
                                echo "uploads/profilePic.png";
                            } else {
                                echo "uploads/" . $getAllUser['picture'];
                            } ?>" alt="profiel foto" class="profilePicture">

            </div>
            <!------profiel------->
            <div id="p-interests">
                <div>
                    <h3><?php echo $getAllUser['firstname'] . " " . $getAllUser['lastname']; ?></h3>
                </div>
                <div>
                    <h5>Korte beschrijving</h5>
                    <p><?php echo $getAllUser['description']; ?></p>
                </div>

                <div>
                    <h5>Interesses</h5>
                    <ul>
                        <li><?php echo $getAllUser['games']; ?></li>
                        <li><?php echo $getAllUser['books']; ?></li>
                        <li><?php echo $getAllUser['films']; ?></li>
                        <li><?php echo $getAllUser['music']; ?></li>
                    </ul>
                    <form class="btn btn-primary" action="" method="post">
                        <input class="btn btn-primary" type="submit" name="return" value="logout">
                    </form>

                </div>
            </div>
        </div>
    </section>
</body>

</html>