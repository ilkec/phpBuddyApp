<?php 
/*Dit kan zowel iemand die een buddy wil begeleiden als iemand die een buddy zoekt
Als je ingaat op een buddy-suggestie van de app, dan wordt er een nieuwe chat opgestart0
met deze persoon waarin staat waarom jullie potentieel een goede IMD-buddy-match zijn (remove awkwardness!)*/


include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");

$conn = Db::getConnection();


$user = new User();
    session_start();
    $databaseId = $user->getDatabaseId();
    $user->setId($databaseId['id']);

    $match = $user->getAll();
    $user->setMatches_ibfk_1($match['buddy']);
    $user->setMatches_ibfk_2($match['leader']);

    $foundmatch = $user->matchUser();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="buddy_match">

    <?php 
    
    foreach($matched as $bm){
        if ($bm ['buddy'] == $user->getMatches_ibfk_1() )
    }

    ?>

    </div>
</body>
</html>