<?php

    include_once(__DIR__ .'/classes/User.php');

    $user = new User();
    session_start();
    $user->setEmail($_SESSION['user']);
    $databaseId = $user->getDatabaseId();
    $user->setId($databaseId['id']);

    if(isset($_SESSION['user'])) {
        $matches = $user->showMatches();
    }else{
        header("Location: feature2.php");
    }
    //var_dump($matches);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Matches</title>
    <style>
        .card{
            width: 18rem;
            margin-bottom: 20px;
        }
        .wrapper{
            margin: 20px 0 0 20px;
        }
    </style>
</head>
<body>
<div class="wrapper"> 
<h3>Match made between</h3>
<?php foreach($matches as $match) :?>
    <div class="card">
        <div class="card-body">
            <?php echo  $match['firstname1'] . " " . $match['lastname1'] . " &amp; " . $match['firstname2'] . " " . $match['lastname2'] ?>  
        </div>
    </div>
    <?php  endforeach; ?> 
</div>      
</body>
</html>