<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="numero1">Numero 1</label>
        <br>
        <input type="number" name="numero1" id="">
        <br>
        <label for="numero2">Numero 2</label>
        <br>
        <input type="number" name="numero2" id="">
        <br>
        <label for="numero3">Numero 3</label>
        <br>
        <input type="number" name="numero3" id="">
        <br>
        <label for="numero4">Numero 4</label>
        <br>
        <input type="number" name="numero4" id="">
        <br>
        <label for="numero5">Numero 5</label>
        <br>
        <input type="number" name="numero5" id="">
        <br>
        <input type="submit" name="Enviar" value="Enviar">
    </form>
    <?php
        if(isset($_POST["Enviar"])){
            $miArray = array();
            foreach($_POST as $clave => $valor){
                $miArray[] = $valor;
            }
            array_pop($miArray); //Quita el ultimo elemneto que es el valor de enviar
            
            include_once ("funcionExterna.php");

            $resultado = calculaValores($miArray);
            print_r($resultado);
        }

    ?>
</body>
</html>