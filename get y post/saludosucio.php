<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_GET["nombre"])){
            echo("<h1>Hola $_GET[nombre]</h1>");
        } else{
            echo("<h1>No tienes nombre</h1>");
        }
   
    ?>
</body>
</html>
