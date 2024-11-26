<?php
// Configura para que entre todo usuario autenticado
// Verificaremos si hay una sesión válida para cualquier usuario
require_once './seguridad.php';
require_once './config.php';

$conexion = new PDO("mysql:host=$DB_host;dbname=$DB_name",$DB_user,$DB_password);
$seguridad = new seguridad($conexion);

if(!$seguridad->autorizar()){
    header("Location: autenticacion.php");
}
?>
<html>

<body>
Esta página la ves porque te has autenticado en el sistema

<a href="salir.php">Cerrar sesion</a>
</body>

</html>
