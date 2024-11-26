<?php
    //Insertamos una persona usando sintaxis mysqli orientada a objetos
    //Traemos las credenciales de conexion
    require_once("./config/configBD.php");
    //Conectamos
    $conexion = new mysqli($BDHost,$BDUser,$BDPassword,$BDName,$BDPort);
    $sql = "insert into `personas`(`id`,`nombre`,`apellido1`,`apellido2`) 
    values
    (null,'Alberto','De La Blanca','Rodriguez'),
    (null,'Paco','Perez','Garcia');";
    if($conexion->query($sql)){
        echo"Insertado correctamente";
    }else{
        echo"Error en la insercion<br>";
        echo $conexion->error;
    }

    //Cerrar la conexion
    $conexion->close();
?>