<?php
if(isset($_POST['enviar'])){
    setcookie("color",$_POST['color'],time()+3600);
    setcookie("texto",$_POST['texto'],time()+3600);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <?php
        if(isset($_COOKIE['color'])){
            echo("body{background-color:".$_COOKIE['color'].";}");
        }
        ?>
        option[value="rojo"]{
            background-color: red;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_COOKIE['texto'])){
        echo("<h1>Hola ".$_COOKIE['texto']."</h1>");
    }
    ?>
    <form action="" method="post">
        <label for="color">Color</label>
        <br>
        <input type="color" name="color" id="color">
        <select name="" id="">
            <option value="rojo">rojo</option>
            <option value="blue">Azul</option>
            <option value="green">Verde</option>
        </select>
        <br>
        <label for="texto">Texto</label>
        <br>
        <input type="text" name="texto" id="">
        <br>
        <input type="submit" name= "enviar" value="Enviar">
    </form>
</body>
</html>