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
    <title>Contacts</title>
</head>

<body>

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

        <input type="submit" value="Bevestigen" name="submit_button">
    </form>

    <?php
    if (isset($_GET['selectedOption'])) {
        switch (isset($_GET['selectedOption'])) {
            case $_GET['selectedOption'] == 'algemeen':
                foreach ($algemeen as $a) { ?>
                    <h3><?php echo $a['firstname'] . " " . $a['lastname'] ?></h3>
                    <h4><?php echo $a['email'] ?></h4>
                    <h4><?php echo $a['responsible'] ?></h4>
                <?php }
                break;
            case $_GET['selectedOption'] == 'code':
                foreach ($code as $c) { ?>
                    <h3><?php echo $c['firstname'] . " " . $c['lastname'] ?></h3>
                    <h4><?php echo $c['email'] ?></h4>
                    <h4><?php echo $c['responsible'] ?></h4>
                <?php }
                break;
            case $_GET['selectedOption'] == 'design':
                foreach ($design as $d) { ?>
                    <h3><?php echo $d['firstname'] . " " . $d['lastname'] ?></h3>
                    <h4><?php echo $d['email'] ?></h4>
                    <h4><?php echo $d['responsible'] ?></h4>
                <?php }
                break;
            case $_GET['selectedOption'] == 'business':
                foreach ($business as $b) { ?>
                    <h3><?php echo $b['firstname'] . " " . $b['lastname'] ?></h3>
                    <h4><?php echo $b['email'] ?></h4>
                    <h4><?php echo $b['responsible'] ?></h4>
                <?php }
                break;
            case $_GET['selectedOption'] == 'communicatie':
                foreach ($communicatie as $com) { ?>
                    <h3><?php echo $com['firstname'] . " " . $com['lastname'] ?></h3>
                    <h4><?php echo $com['email'] ?></h4>
                    <h4><?php echo $com['responsible'] ?></h4>
                <?php }
                break;
            case $_GET['selectedOption'] == 'hardware':
                foreach ($hardware as $h) { ?>
                    <h3><?php echo $h['firstname'] . " " . $h['lastname'] ?></h3>
                    <h4><?php echo $h['email'] ?></h4>
                    <h4><?php echo $h['responsible'] ?></h4>
    <?php }
                break;
            default:
        }
    }
    ?>
</body>

</html>