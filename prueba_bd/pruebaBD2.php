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
    $sql = "insert into `personas`(`id`,`nombre`,`apellido1`,`apellido2`) 
    values
    (null,?,?,?);";
    $persona = ["Manolo","Perez","Lazaro"];
    $sentencia = $conexion->prepare($sql);
    if($sentencia->execute($persona)){
        echo("Insercion realizada correctamente");
    }

    $sql = "insert into `personas`(`id`,`nombre`,`apellido1`,`apellido2`) 
    values
    (null, :n, :a1, :a2);"; 
    $persona = ["Sergio","Lopez","Torres"];
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam(":n",$persona[0]);
    $sentencia->bindParam(":a1",$persona[1]);
    $sentencia->bindParam(":a2",$persona[2]);
    if($sentencia->execute()){
        echo("<br>Insercion realizada correctamente");
    }

    $conexion = null;
?>