<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <script src="https://kit.fontawesome.com/6792ce1460.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#searchBar").keyup(function(){
                var name = $("#searchBar").val();
                $.post("doSearchStuff.php", {
                    suggestion: name
                }, function(data, status){
                    $("#output").html(data);
                });
            });
        });
    </script>
</head>
<body>
    <input type="text" id="searchBar" placeholder="search">
    <div>
        <ul id="output">
        </ul>
    </div>
</body>
</html>