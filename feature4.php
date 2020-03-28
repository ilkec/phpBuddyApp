<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");


$user = new User();

session_start();
// $user->setEmail($_SESSION['user']); //
$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']);


/* 
if (!empty($_POST)) {
    if (!empty($_POST['games']) || !empty($_POST['films']) || !empty($_POST['music']) || !empty($_POST['location']) || !empty($_POST['books'])) {

        try {

            $user->setGames($_POST['games']);
            $user->setFilms($_POST['films']);
            $user->setMusic($_POST['music']);
            $user->setLocation($_POST['location']);
            $user->setBooks($_POST['books']);
            $user->setId($databaseId['id']);

            $user->saveInterests();
            //header('Location:profile.php');
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }
    } else {
        echo "<h3>Gelieve alle velden in te vullen.</h3>";
    }
}
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="bg">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                <?php echo $error ?>
            <?php endif; ?>
            <h2 class="container mt-5 w-25"> Vervolledig u profiel </h2>
            <form class="container w-25 border border-primary rounded" action="" method="post">
                <div class="form__field mt-2">
                    <label for="Games">Games</label>
                    <input class="form-control" type="text" id="Games" name="games" placeholder="Vul u favoriete game in">
                </div>

                <div class="form__field mt-2">
                    <label for="Films">Films</label>
                    <input class="form-control" type="text" id="Films" name="films" placeholder="Vul u favoriete film in">
                </div>


                <div class="form__field mt-2">
                    <label for="Music">Music</label>
                    <input class="form-control" type="text" id="Music" name="music" placeholder="Vul u favoriete artiest in">
                </div>


                <div class="form__field mt-2">
                    <label for="Location">Location</label>
                    <input class="form-control" type="text" id="Location" name="location" placeholder="Vul u stad/dorp in">
                </div>


                <div class="form__field mt-2">
                    <label for="Books">Books</label>
                    <input class="form-control mb-3" type="text" id="Books" name="books" placeholder="Vul u favoriete schrijver in">
                </div>

                <input class="btn btn-primary mb-3" type="submit" value="Bevestigen" name="submit_button">
                <?php if (!empty($_POST)) {
                    if (empty($_POST['games']) || empty($_POST['films']) || empty($_POST['music']) || empty($_POST['location']) || empty($_POST['books'])) {
                        echo "<h3>Gelieve alle velden in te vullen.</h3>";
                    } else {

                        try {
                            // $user = new User(); //
                            $user->setGames($_POST['games']);
                            $user->setFilms($_POST['films']);
                            $user->setMusic($_POST['music']);
                            $user->setLocation($_POST['location']);
                            $user->setBooks($_POST['books']);

                            $user->saveInterests();
                            header('Location:profile.php');
                            // header('Location:profile.php'); //
                        } catch (\Throwable $th) {
                            $error = $th->getMessage();
                        }
                    }
                } ?>

            </form>
            </div>
</body>

</html>