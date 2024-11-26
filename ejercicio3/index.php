<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once("./externo.php");
        if(isset($_POST["num1"]) && isset($_POST["num2"])){
            $potencia = potencia($_POST["num1"],$_POST["num2"]);
            echo("<h1>$potencia</h1>");
        }else {
    ?>
    <form action="" method="post">
        <input type="text" name="num1">
        <br>
        <input type="text" name="num2">
        <br>
        <input type="submit" value="Calcular potencia">
    </form>
    <?php
        }
    ?>
</body>
</html>