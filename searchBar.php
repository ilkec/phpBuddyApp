<?php
    include_once(__DIR__ . '/classes/Db.php');

    //to prevent errors, check if post has suggestions
    if(isset($_POST['suggestion'])){                                 //kijkt of de post is geset 
        //save most recent suggestion
        $name = $_POST['suggestion'];                                //probeert naam uit de post te halen, slaagt meest recente suggestie op
        //connect to database and fetch all names
        $conn       = Db::getConnection();                          //zonder bovenstande werkt onderste ni
        $statement  = $conn->prepare("SELECT * FROM users");
        $result     = $statement->execute();
        $result     = $statement->fetchAll(PDO::FETCH_ASSOC);
        $names      = array();
        foreach($result as $row){       
            array_push($names, $row['firstname'] . " " . $row['lastname']);     //array is om alle namen op te slagen
        }
        //check to see if name is empty to prevent errors
        if(!empty($name)){
            $i = 0;
            foreach($result as $row){
                //go through all the names to check if they match to either first or last names of users
                if(stripos($names[$i], $name) !== false){                                      //stripos kijkt na of de namen overeenkomen met elkaar
                    echo '<a href="profileOfUser.php?id=' . $row['id'] . '"><li>' . $names[$i] . '</li></a>';
                }
                $i = $i + 1;
            }
        }
    }



