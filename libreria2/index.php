<?php
require_once "usuarios.php";
require_once "seguridad.php";
$seguridad = new Seguridad();

    if(!file_exists('config.php')){
        header('Location: install.php');
    }
    if(isset($_POST['enviar'])){
        require_once 'usuarios.php';
        require_once 'conexion.php';
        $usuario = new usuario(conexion::getConn());
        $user = $_POST['usuario'];
        $password = $_POST['password'];
        $login = $usuario->login($user, $password);
        if($login){
            session_start();
            $_SESSION['usuario'] = $login['login'];
            $_SESSION['rol'] = $login['rol'];
            $_SESSION['nombre'] = $login['nombre'];
            $_SESSION['apellidos'] = $login['apellidos'];
            $_SESSION["ip"] = $_SERVER['REMOTE_ADDR'];
            header('Location: index.php');
        }else{
            header('Location: index.php?err=Usuario o contraseña incorrectos');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca 2.0</title>
    <link rel="stylesheet" href="./style.css">
    <link type="image/png" sizes="16x16" rel="icon" href="./imagenes/icons8-libro-16.png">
</head>
<body>
        <?php
        if(isset($_GET['msg'])){
            echo "<h2 class = 'instalacion'>".$_GET['msg']."</h2>";
        }
        if(isset($_GET['err'])){
            echo "<h2 class = 'error'>".$_GET['err']."</h2>";
        }
        ?>
        <h1>Bienvenido a la biblioteca 2.0</h1>
        <?php
            if($seguridad->acceso('registrado', 'bibliotecario', 'administrador')){
                echo "<h2>Bienvenido ".$_SESSION['usuario']."</h2>";
        ?>
        <nav id='menu'>
            <ul>
        <li><a href="listadoLibros.php">Listado de libros</a></li>
        <li><a href="cambiarPassword.php">Cambiar contraseña</a></li>
        <li><a href="modificarPerfil.php">Modificar mis datos</a></li>
        <?php
            if($seguridad->acceso('bibliotecario')){
        ?>
        <li><a href="listadoAutores.php">Listado de autores</a></li>
        <li><a href="insertarLibro.php">Insertar libro</a></li>
        <?php
            }
            if($seguridad->acceso('administrador')){
        ?>
        <li><a href="gestionUsuarios.php">Gestion de usuarios</a></li>
        <?php
            }
            echo "<li><a href='cerrarSesion.php'>Cerrar sesion</a></li>";
        ?>
        </ul>
        </nav>
        <?php
        }else{
        ?>
        <form action="" method="post">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario">
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password">
            <br>
            <div class="entrar">
                <input type="submit" name="enviar" value="Entrar" class="entrar">
                <button class="registrar"><a href="registro.php">Registrate</a></button>
            </div>
        </form>
        <?php
        }
        ?>
    
    <footer>
        <p>Desarrollado por: <a href="">@Alberto de la blanca</a></p>
    </footer>
</body>
</html>