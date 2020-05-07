<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#searchButton").click(function(){
                var input = $("#monsieur").val();
                $("#output").load("doSearchStuff.php", {
                    input: input
                });
            });
        });

        //----what does what------
        //$(document).ready(function(){});                      -- if the document is loaded do the function
        //$("#searchButton").click(function(){});               -- find html element with id 'searchButton' and do function
        //$("#output").load("doSearchStuff.php)                 -- add "doSearchStuff.php" page to the "output" html element
        //.load() => syntax for AJAX -> add the page in the () to the selector and perform any code (without refreshing page)
        // .click voegt een event toe aan een element

        //----basics jquery------
        //$("#elementId" of ".elementClass") = selector -> selecteer het element in de ()
        //.stuff() = function -> do something with a selector
        
    </script>
</head>
<body>
</body>
</html>