<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");


$user = new User();

session_start();
$user->setEmail($_SESSION['user']);
$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']);

if (isset($_SESSION['user'])) {
    if (!empty($_POST)) {
        if (!empty($_POST['games']) && !empty($_POST['films']) && !empty($_POST['music']) && !empty($_POST['location']) && !empty($_POST['books'])) {

            try {

                $user->setGames($_POST['games']);
                $user->setFilms($_POST['films']);
                $user->setMusic($_POST['music']);
                $user->setLocation($_POST['location']);
                $user->setBooks($_POST['books']);
                $user->saveInterests();
                header('Location:feature5.php');
            } catch (\Throwable $th) {
                $error = $th->getMessage();
            }
        } else {
            echo "<h3>Gelieve alle velden in te vullen.</h3>";
        }
    }
} else {
    header("Location:feature2.php");
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

<body class="container-fluid bg-secondary">
    <div class="row">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                <?php echo $error ?>
            <?php endif; ?>
            <img src="img/we-are-imd.jpg" alt="weareimd" class="col-lg-6 col-md-6 d-none d-md-block" id="login-img">
            <form class="col-lg-6 col-md-6" id="login-form" action="" method="post">
                <h2> Vervolledig u profiel </h2>
                <div class="form__field mt-2">
                    <label for="Games">My favorite genre of games</label>
                    <select class="form-control" type="text" id="Games" name="games">
                        <option value="Adventure">Action</option>
                        <option value="Fighting">Fighting</option>
                        <option value="Platforming">Platforming</option>
                        <option value="RPG">RPG</option>
                        <option value="Shooter">Shooter</option>
                        <option value="Sports">Sports</option>
                    </select>
                </div>

                <div class="form__field mt-2">
                    <label for="Films">My favorite genre of films</label>
                    <select class="form-control" type="text" id="Films" name="films">
                        <option value="Action">Action</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Drama">Drama</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Horror">Horror</option>
                        <option value="Science fiction">Science fiction</option>
                        <option value="Romance">Romance</option>
                        <option value="Thriller">Thriller</option>
                    </select>
                </div>


                <div class="form__field mt-2">
                    <label for="Music">My favorite music genre</label>
                    <select class="form-control" type="text" id="Music" name="music">
                        <option value="Country">Country</option>
                        <option value="House">House</option>
                        <option value="Jazz">Jazz</option>
                        <option value="Klassiek">Klassiek</option>
                        <option value="Pop">Pop</option>
                        <option value="Rap">Rap</option>
                        <option value="Rock">Rock</option>
                        <option value="Techno">Techno</option>
                    </select>
                </div>


                <div class="form__field mt-2">
                    <label for="Location">Location</label>
                    <input class="form-control" type="text" id="Location" name="location" placeholder="What city/town do you live in ?">
                </div>


                <div class="form__field mt-2">
                    <label for="Books">My favorite genre of books</label>
                    <select class="form-control mb-3" type="text" id="Books" name="books">
                        <option value="Action">Action</option>
                        <option value="Biography">Biography</option>
                        <option value="Comics">Comics</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="History">History</option>
                        <option value="Horror">Horror</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Science fiction">Science fiction</option>
                    </select>
                </div>

                <input class="btn btn-primary mb-3" type="submit" value="Bevestigen" name="submit_button">




            </form>
            </div>
</body>

</html>