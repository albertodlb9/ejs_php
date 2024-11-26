<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if(isset($_POST['nombre']) && $_POST['nombre'] != ""){
        echo("<h1>Hola $_POST[nombre]</h1>");
    } else{ ?>
    <form action="" method="post">
    <input type="text" name="nombre">
    <input type="submit" value="Enviar">
    </form>
    <?php }
    ?>
</body>
</html>