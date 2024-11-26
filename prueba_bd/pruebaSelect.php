<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once("./config/configBD.php");
        $conexion = new mysqli($BDHost,$BDUser,$BDPassword,$BDPassword);
        $sql = "select * from personas;";

        if($resultado=$conexion->query($sql)){
            echo"<table>";
            while($fila = $resultado->fetch_object()){
                echo"<tr>";
                echo"<td>$fila->id</td>
                <td>$fila->nombre</td>
                <td>$fila->apellido1</td>
                <td>$fila->apellido2</td>";
                echo"</tr>";
            }
            echo"</table>";
        }else{
            echo"Error al hacer la consulta";
            echo $conexion->error;
        }
    ?>
</body>
</html>

