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
    header("Location: login.php");
}

if (isset($_POST['return'])) {
    session_start();
    session_unset();
    session_destroy();

    header("Location: login.php");
    exit;
}

try {
    $allBuddy = $user->profileBuddy();
} catch (\Throwable $th) {
    $allBuddy = "This person doesn't have buddies";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
</head>


<body>
    <div class="full">
        <a href="sortBuddy.php">
            <img class='back-btn' src="img/back.png" alt="">
        </a>
        <section class="container-fluid">
            <div id="profile" class="col-lg-6 col-md-6 profile-form">
                <div class="profile1">
                    <div class="profilePictureWrap">
                        <img src="<?php if ($getAllUser['picture'] === NULL) {
                                    echo "uploads/profilePic.png";
                                } else {
                                    echo "uploads/" . $getAllUser['picture'];
                                } ?>" alt="profiel foto" class="profilePicture">
                    </div>
                    <a href="profileSettings.php"><img class="icon1" src="img/settings.png" alt="settingsIcon"
                            id="settingsIcon"></a>

                </div>
                <!------profiel------->
                <div id="p-interests">
                    <div>
                        <h3><?php echo htmlspecialchars($getAllUser['firstname']) . " " . htmlspecialchars($getAllUser['lastname']); ?>
                        </h3>
                    </div>
                    <div>
                        <h5 class='title'>Bio</h5>
                        <p><?php echo htmlspecialchars($getAllUser['description']); ?></p>
                    </div>

                    <div>
                        <h5 class="title">Interests</h5>
                        <ul>
                            <li><?php echo $getAllUser['games']; ?></li>
                            <li><?php echo $getAllUser['books']; ?></li>
                            <li><?php echo $getAllUser['films']; ?></li>
                            <li><?php echo $getAllUser['music']; ?></li>
                        </ul>
                        <h5 class="title">Buddy</h5>
                        <ul>
                            <?php if ($allBuddy == null) {
                            echo "This user doesn't have a buddy";
                        } else { ?>
                            <?php foreach ($allBuddy as $b) { ?>
                            <?php echo $b['firstname'] . " " . $b['lastname'] ?>
                            <?php }
                        } ?>
                        </ul>

                        <form action="" method="post">
                            <input class="logout" type="submit" name="return" value="logout">
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>
</body>

</html>