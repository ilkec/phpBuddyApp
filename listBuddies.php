<?php

include_once(__DIR__ . '/classes/User.php');

$user = new User();
session_start();
$user->setEmail($_SESSION['user']);
$databaseId = $user->getDatabaseId();
$user->setId($databaseId['id']);

if (isset($_SESSION['user'])) {
    $matches = $user->showMatches();
    $matchesCount = count($matches);
   if($matchesCount === 0){
       $noMatches = "There were no matches found";
   }

} else {
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Matches</title>
  
</head>

<body>
<?php include_once("navbar.php")?>
    <div class="wrapper">
        <h2 class="h2-buddy">Match made between</h2>
       
        <div class="cards">
            <?php if(isset($noMatches)) : ?>
            <p class="emptyState"><?php echo $noMatches;?></p>
            <?php endif; ?>
            <?php foreach ($matches as $match) : ?>
                <div class="card">
                    <div class="card-body">
                        <img src="<?php if ($match['picture1'] === NULL) {
                                        echo "uploads/profilePic.png";
                                    } else {
                                        echo "uploads/" . $match['picture1'];
                                    } ?>" alt="profiel foto" class="profilePictureMatch">
                        <p class="namesMatches"><?php echo  htmlspecialchars($match['firstname1']) . " " . htmlspecialchars($match['lastname1']) . " &amp; " . htmlspecialchars($match['firstname2']) . " " . htmlspecialchars($match['lastname2']); ?> </p>
                        <img src="<?php if ($match['picture2'] === NULL) {
                                        echo "uploads/profilePic.png";
                                    } else {
                                        echo "uploads/" . $match['picture2'];
                                    } ?>" alt="profiel foto" class="profilePictureMatch">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>