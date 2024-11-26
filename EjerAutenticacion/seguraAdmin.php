<?php
// Configura para que solo pueda entrar el rol admin
// Verificaremos que hay una sesión válida solamente para el rol de admin
require_once './seguridad.php';
require_once './config.php';

$conexion = new PDO("mysql:host=$DB_host;dbname=$DB_name",$DB_user,$DB_password);
$seguridad = new seguridad($conexion);

if(!$seguridad->autorizar("admin")){
    header("Location: autenticacion.php");
}
?>
<html>

<body>
Esta página la ves porque te has autenticado en el sistema como admin

<a href="salir.php">Cerrar sesion</a>
</body>

</html>
