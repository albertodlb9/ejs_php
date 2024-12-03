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
        if(isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == UPLOAD_ERR_OK){    
            $ruta = $_FILES["avatar"]["tmp_name"];
            $tipo = $_FILES["avatar"]["type"];
            $tam = $_FILES["avatar"]["size"];
            $destino = "./imagenes/".$login;
            $avatar = $destino;
            if(move_uploaded_file($ruta, $avatar) && $tam < 1000000){    
                $usuario->registrar($nombre, $apellidos, $login, $password,$avatar);
                header('Location: index.php?msg=Usuario registrado correctamente');
            }else{
                header('Location: index.php?err=Error al registrar el usuario');
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
    <link type="image/png" sizes="16x16" rel="icon" href="./imagenes/icons8-libro-16.png">
</head>
<body>
    <h1>Biblioteca 2.0</h1>
    <nav>
        <ul>
            <li><a href="index.php">Volver al inicio</a></li>
        </ul>
    </nav>
    <h2>Registro de usuario</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="avatar">Avatar:</label>
        <input type="file" name="avatar" id="avatar">
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