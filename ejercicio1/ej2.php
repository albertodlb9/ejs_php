<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    foreach($_SERVER as $i => $valor){
        echo "<p>$i --> $valor </p>";
    }
    echo "<hr/>";
    foreach($_ENV as $clave => $valor2){
        echo "<p>$clave --> $valor2</p>";
    }
    ?>
</body>
</html>