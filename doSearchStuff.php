<?php
    include_once(__DIR__ . '/classes/Db.php');
    //to prevent errors, check if post has suggestions
    if(isset($_POST['suggestion'])){
        //save most recent suggestion
        $name = $_POST['suggestion'];
        //connect to database and fetch all names
        $conn       = Db::getConnection();
        $statement  = $conn->prepare("SELECT firstname, lastname FROM users");
        $result     = $statement->execute();
        $result     = $statement->fetchAll(PDO::FETCH_ASSOC);
        $names      = array();
        foreach($result as $row){
            array_push($names, $row['firstname'] . " " . $row['lastname']);
        }
        //check to see if name is empty to prevent errors
        if(!empty($name)){
            $i = 0;
            foreach($result as $row){
                //go through all the names to check if they match to either first or last names of users
                if(stripos($names[$i], $name) !== false){
                    echo "<a href='profileOfUser.php'><li>" . $names[$i] . "</li></a>";
                }
                $i = $i + 1;
            }
        }
    }

    
// profile pagina kopieren en die kopie hernoemen naar 'profileOfUser' met de naam van de huidige user in de url (da is optie)
// de email van de user waarop je klikt in de sessie steken onder naam 'targetUser'
// op de nieuwe 'profileOfUser' pagina haal je de email uit de sessie net zoals normaal maar ipv 'user' is het nu 'targetUser'




?>

