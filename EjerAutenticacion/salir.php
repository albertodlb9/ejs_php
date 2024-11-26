<?php
require_once './seguridad.php';
require_once './config.php';

$conexion = new PDO("mysql:host=$DB_host;dbname=$DB_name",$DB_user,$DB_password);
$seguridad = new seguridad($conexion);
$seguridad->cerrarSesion();
header("Location: autenticacion.php");
// configura para destruir la sesión y volver a la página de inicio
?>
