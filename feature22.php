<?php

include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Db.php');

$user = new User();
session_start();

// $_POST['selectedOption'] = null;
$algemeen = $user->showAlgemeen();
$code = $user->showCode();
$design = $user->showDesign();
$business = $user->showBusiness();
$communicatie = $user->showCommunicatie();
$hardware = $user->showHardware();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Contacts</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid"> <a class="navbar-brand" href="sortBuddy.php"><img src="img/Logo.png" width="70em" alt="MyBuddyApp"></a>
        </div>
    </nav>
    <div class="container-fluid box pb-5">
        <form id="dropdown" action="" method="get">
            <label for="responsible">In welk veld hebt u hulp nodig ?</label>

            <select type="text" name="selectedOption">
                <option value="algemeen">Algemeen</option>
                <option value="code">Code</option>
                <option value="design">Design</option>
                <option value="business">Business</option>
                <option value="communicatie">Communicatie</option>
                <option value="hardware">Hardware</option>
            </select>

            <input class="btn btn-primary" type="submit" value="Bevestigen" name="submit_button">


            <?php
            if (isset($_GET['selectedOption'])) {
                switch (isset($_GET['selectedOption'])) {
                    case $_GET['selectedOption'] == 'algemeen':
                        foreach ($algemeen as $a) { ?>
                            <h3 class="lead font-weight-bold"><?php echo $a['firstname'] . " " . $a['lastname'] ?></h3>
                            <h4 class="lead"><?php echo $a['email'] ?></h4>
                            <h4 class="lead"><?php echo $a['responsible'] ?></h4><br>
                        <?php }
                        break;
                    case $_GET['selectedOption'] == 'code':
                        foreach ($code as $c) { ?>
                            <h3 class="lead font-weight-bold"><?php echo $c['firstname'] . " " . $c['lastname'] ?></h3>
                            <h4 class="lead"><?php echo $c['email'] ?></h4>
                            <h4 class="lead"><?php echo $c['responsible'] ?></h4><br>
                        <?php }
                        break;
                    case $_GET['selectedOption'] == 'design':
                        foreach ($design as $d) { ?>
                            <h3 class="lead font-weight-bold"><?php echo $d['firstname'] . " " . $d['lastname'] ?></h3>
                            <h4 class="lead"><?php echo $d['email'] ?></h4>
                            <h4 class="lead"><?php echo $d['responsible'] ?></h4><br>
                        <?php }
                        break;
                    case $_GET['selectedOption'] == 'business':
                        foreach ($business as $b) { ?>
                            <h3 class="lead font-weight-bold"><?php echo $b['firstname'] . " " . $b['lastname'] ?></h3>
                            <h4 class="lead"><?php echo $b['email'] ?></h4>
                            <h4 class="lead"><?php echo $b['responsible'] ?></h4><br>
                        <?php }
                        break;
                    case $_GET['selectedOption'] == 'communicatie':
                        foreach ($communicatie as $com) { ?>
                            <h3 class="lead font-weight-bold"><?php echo $com['firstname'] . " " . $com['lastname'] ?></h3>
                            <h4 class="lead"><?php echo $com['email'] ?></h4>
                            <h4 class="lead"><?php echo $com['responsible'] ?></h4><br>
                        <?php }
                        break;
                    case $_GET['selectedOption'] == 'hardware':
                        foreach ($hardware as $h) { ?>
                            <h3 class="lead font-weight-bold"><?php echo $h['firstname'] . " " . $h['lastname'] ?></h3>
                            <h4 class="lead"><?php echo $h['email'] ?></h4>
                            <h4 class="lead"><?php echo $h['responsible'] ?></h4><br>
            <?php }
                        break;
                    default:
                }
            }
            ?>
        </form>
    </div>
</body>

</html>