<?php
/* instalar.php 
  Crea la tabla alumnos con los campos:Nombre,Apellido1,Apellido2, DNI(PK)
  * 
  */
  
echo "Pasos para Crear la tabla alumnos con los campos:Nombre,Apellido1,Apellido2, DNI(PK) que gestionaremos en el ejercicio";

//incluyo la configuracion
require_once "config.php";


echo "<br>Conectando con la BD";
echo '<br>$conexion= new PDO("$DBdriver:host=$DBHost;dbname=$DBName;", $DBUser, $DBPassword);';
//$conexion=mysqli_connect($host,$user,$password,$db); //alternativa con sintaxis funcional
//$conexion=new mysqli($host,$user,$password,$db) or die("Problemas en la conexion".$conexion->connect_error);
try{
$conexion=new PDO("$DBdriver:host=$DBHost;dbname=$DBName;", $DBUser, $DBPassword);
}catch(PDOException $e){
  die("No has configurado bien config.php"); //Terminamos el script enviando el mensaje.
}
$consulta="CREATE TABLE `alumnos` ( `Nombre` VARCHAR(50) NOT NULL , `Apellido1` VARCHAR(50) NOT NULL , `Apellido2` VARCHAR(50) NOT NULL , `DNI` VARCHAR(10) NOT NULL , PRIMARY KEY (`DNI`) );";
echo "<P> Ejecutandando la consulta $consulta</P>";
//mysqli_query($conexion,$consulta); //alternativa con sintaxis funcional
//$conexion->query($consulta);
//echo '<br> $conexion->query($consulta);';
echo '$conexión->query($consulta);';
$conexion->query($consulta);


echo '<br>Insertando alumnos ficticios';
$consulta="INSERT INTO `alumnos` (`Nombre`, `Apellido1`, `Apellido2`, `DNI`) VALUES ('ficticio1', 'ficticio1', 'ficticio1', 'ficticio1'), ('ficticio2', 'ficticio2', 'ficticio2', 'ficticio2');";
//mysqli_query($conexion,$consulta); //alternativa con sintaxis funcional
echo "<p> Ejecutando la consulta: <br> $consulta";
$conexion->query($consulta);
echo '<br>$conexión->query($consulta);';

echo "<br>Cerrando la conexión";
unset($conexion);
echo 'unset($conexion);';
//echo '<br> $conexion->close();';
//mysqli_close($conexion); //alternativa con sintaxis funcional

echo ' <br>Todo creado con éxito. <br> Vuelva a ejerTabla.php <a href="ejerTabla.php">ejercicio</a>"';
