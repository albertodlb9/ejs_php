<?php
    if(!file_exists("./config/config.php")){
        header("Location: ./install/install.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <?php
        include_once './config/templates.php';
        echo $cabecera;
        echo $pie;
    ?>
  

</body>
</html>