<?php
    require_once 'seguridad.php';
    $seguridad = new Seguridad();
    if($seguridad->acceso('registrado', 'bibliotecario', 'administrador')){
        header('Location: index.php');
    }

    if(isset($_POST['registrar'])){
        require_once 'conexion.php';
        require_once 'usuarios.php';
        $usuario = new usuario(conexion::getConn());
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $login = $_POST['usuario'];
        $password = $_POST['password'];
        $usuario->registrar($nombre, $apellidos, $login, $password);
        header('Location: index.php?msg=Usuario registrado correctamente');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Biblioteca 2.0</h1>
    <h2>Registro de usuario</h2>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" required>
        <br>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" name="registrar" value="Registrar">
    </form>
</body>
</html>