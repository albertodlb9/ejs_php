<?php
    //Insertamos una persona usando sintaxis PDO orientada a objetos
    //Traemos las credenciales de conexion
    require_once("./config/configBD.php");
    //Conectamos
    
    try{
    $conexion = new PDO("$BDType:host=$BDHost; dbname=$BDName", $BDUser, $BDPassword);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }catch(PDOException $e){
        echo ("Fallo la conexion: ". $e->getMessage());
        exit();
    }

    $sql = "Select * from `personas`;";
    $sentencia = $conexion->prepare($sql);
    $sentencia->setFetchMode(PDO::FETCH_OBJ);
    $sentencia->execute();

    echo"<table>";
            while($fila = $sentencia->fetchObject()){
                echo"<tr>";
                echo"<td>$fila->id</td>
                <td>$fila->nombre</td>
                <td>$fila->apellido1</td>
                <td>$fila->apellido2</td>";
                echo"</tr>";
            }
            echo"</table>";