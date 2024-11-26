<?php
    if(isset($_GET["img"])){
        $nombreArchivo = basename($_GET["img"]);
        unlink("imagenes/$nombreArchivo");
        header("Location:index.php");
    }
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
    <style>
        td{
            outline: solid 1px black;
        }
    </style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="imagen">Sube una imagen</label>
        <br>
        <input type="file" name="imagen">
        <input type="submit" name="enviar" value="enviar">
    </form>
    <?php
        if(isset($_POST["enviar"])){

        $nombre = $_FILES["imagen"]["name"];
        $ruta = $_FILES["imagen"]["tmp_name"];
        $tipo = $_FILES["imagen"]["type"];
        $tamaño = $_FILES["imagen"]["size"];

            $destino = "./imagenes/".$nombre;

            if($tamaño > 200000){
                echo "El archivo supera los 2MB";
            }else if($tipo != "image/jpeg" && $tipo != "image/png" && $tipo != "image/gif" && $tipo != "pdf"){
                echo "El tipo de archivo no es correcto";
            }else{
                if(move_uploaded_file($ruta,$destino)){
                    echo "El archivo se ha subido correctamente";
                } else{
                    echo "Ocurrio algun error al subir el fichero.";
                }
            }
        }
    ?>
    <?php
        echo"<h1>Imagenes</h1>";
        $directorio = "imagenes";
        $archivos = scandir("imagenes/");
        echo("<table>");
        $n = 0;
        echo("<tr>");
        foreach($archivos as $clave => $valor){
            if($valor != "." && $valor != ".."){
                if($n == 3){
                    echo"</tr>";
                    echo"<tr>";
                    $n = 0;
                }
                echo"<td>";
                echo"<img src='$directorio/$valor' width='400'>";
                echo"<a href='?img=$valor'>Eliminar</a>";
                echo"</td>";
                $n++;
            }
        }
        echo"</tr>";
        echo"</table>";

    ?>
</body>
</html>