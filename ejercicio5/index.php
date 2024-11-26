<?php    
    $nombreArchivo = "datos.txt";
    if(isset($_GET['fila'])){
        $fila=htmlspecialchars($_GET['fila']);
        $fpAux = fopen("aux.csv","w");
        if($fp = fopen($archivo,"r")){
            for($i = 0; $i < $fila ;$i++){
                $pedido = fgetcsv($fp,0,";",'"');
                fputcsv($fpAux, $pedido,";",'"');
            }
            $pedido = fgetcsv($fp,0,";",'"');
            print_r($pedido);
            $desplazamiento = count($pedido)+1;
            if($pedido[5] == false){
                $pedido[5] = true;
            }else{
                $pedido[5] = false;
            }
            fputcsv($fpAux, $pedido,";",'"');
            while($pedido = fgetcsv($fp,0,";",'"')){
                fputcsv($fpAux, $pedido,";",'"');
            }
            fclose($fp);
            fclose($fpAux);
            unlink($nombreArchivo);
            rename("pedidos.csv",$nombreArchivo);
        }
        header("Location:index.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ejercicio 5</title>
    <style>
        td{
            outline: solid 1px black;
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>

</head>
<body>
    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <br>
        <input type="text" name="nombre" id="">
        <br>
        <label for="direccion">Direccion</label>
        <br>
        <input type="text" name="direccion" id="">
        <br>
        <label for="jamon">Jamon y queso</label>
        <input type="checkbox" name="jamon" id="">
        <label for="cantidadJamon">Cantidad</label>
        <input type="number" name="cantidadJamon" id="">
        <br>
        <label for="napolitana">Napolitana</label>
        <input type="checkbox" name="napolitana" id="">
        <label for="cantidadNapolitana">Cantidad</label>
        <input type="number" name="cantidadNapolitana" id="">
        <br>
        <label for="mozzarella">Mozzarella</label>
        <input type="checkbox" name="mozzarella" id="">
        <label for="cantidadMozzarella">Cantidad</label>
        <input type="number" name="cantidadMozzarella" id="">
        <br>
        <input type="submit" value="Confirmar" name="confirmar">
    </form>
    <?php
    if(isset($_POST["confirmar"])){
        $archivo = "datos.txt";
        $array = [];

        foreach($_POST as $clave => $valor){
            if($clave !=="jamon" && $clave !== "napolitana" && $clave !== "mozzarella"){
                if($valor === ""){
                    $array[$clave] = 0;
                }else{
                    $array[$clave] = "$valor";
                }
            }
        }
        array_pop($array);
        array_push($array,"false");

        if(!$fp = fopen($archivo,"a")){
            echo"No se ha podido completar el pedido";
        }else{
            if(filesize($archivo) === 0){
            fputcsv($fp,["Nombre","Direccion","Jamon y queso","Napolitana","Mozzarella","Realizado"],";",'"');
            } 
            fputcsv($fp,$array,";",'"');
             fclose($fp);
             echo "El pedido se ha realizado correctamente";
        }
        
    }
    include_once("listaPedidos.php");
        crearTabla($archivo);
    ?>
</body>
</html>