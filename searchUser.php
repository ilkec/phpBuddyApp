<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <script src="https://kit.fontawesome.com/6792ce1460.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/profileOfUser.css">

    <script>
        $(document).ready(function(){                       //jQuerey word pas uitgevoerd als het geladen is
            $("#searchBar").keyup(function(){               //vanaf er in de searchbar iets verandert 
                var name = $("#searchBar").val();           //komt het hier in de variabele te stan
                $.post("doSearchStuff.php", {               //de php word uitgevoerd en de variabele word gePOST
                    suggestion: name
                }, function(data, status){                  //gaat de data van doSearchStuff opvragen en gebruiken
                    $("#output").html(data);                //de opgevraagde data word in de html getoond
                });
            });
        });
    </script>
</head>
<body>
    <input type="text" class='searchbar' id="searchBar" placeholder="search who is also on this app">
    <div >
        <ul class='aah' id="output">

        </ul>
    </div>
</body>
</html>