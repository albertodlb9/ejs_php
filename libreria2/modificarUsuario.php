<?php
    require_once 'seguridad.php';
    $seguridad = new Seguridad();
    if(!$seguridad->acceso('administrador')){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar usuario</title>
</head>
<body>
    <h1>Modificar usuario</h1>
    <?php
    if(isset($_GET['login'])){
        require_once 'usuarios.php';
        require_once 'conexion.php';
        $usuario = new usuario(conexion::getConn());
        $login = $_GET['login'];
        $datos = $usuario->listar($login);
        $nombre = $datos['nombre'];
        $apellidos = $datos['apellidos'];
        $rol = $datos['rol'];
        $salt = $datos['salt'];

    }
    ?>
</body>
</html>