<?php
require_once "seguridad.php";
    $seguridad = new Seguridad();
    if(!$seguridad->acceso("registrado","bibliotecario","administrador")){
        header("Location: index.php");
    }
    if(isset($_POST["enviar"])){
        require_once "usuarios.php";
        require_once "conexion.php";
        $oldPassword = $_POST["oldPassword"];
        $newPassword = $_POST["newPassword"];
        $repeatPassword = $_POST["repeatPassword"];
        $usuario = new usuario(conexion::getConn());
        $datos = $usuario->buscar($_SESSION["usuario"]);
        $userPassword = $datos["password"];
        $userSalt = $datos["salt"];
        if($newPassword == $repeatPassword && password_verify($oldPassword.$userSalt,$userPassword)){
            $usuario->cambiarPassword(password_hash($newPassword.$userSalt,PASSWORD_DEFAULT),$_SESSION["usuario"]);
            header("Location: cambiarPassword.php?msg=El cambio de password se realizo correctamente");
        }else{
            header("Location: cambiarPassword.php?err=El cambio de password ha fallado");

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        if(isset($_GET['msg'])){
            echo "<h2 class='instalacion'>".$_GET['msg']."</h2>";
        }
        if(isset($_GET['err'])){
            echo "<h2 class='error'>".$_GET['err']."</h2>";
        }
        if(isset($_SESSION['rol'])){
            $usuario = $_SESSION['usuario'];
            echo "<p><strong>$usuario</strong>  <a href='cerrarSesion.php'>Cerrar sesion</a></p>";
        }   
    ?>
    <h1>Cambiar contraseña</h1>
    <nav>
        <ul>
            <li><a href="index.php">Volver al inicio</a></li>
        </ul>
    </nav>
    <form action="" method="post">
        <label for="oldPassword">Contraseña actual: </label>
        <input type="password" name="oldPassword" id="">
        <br>
        <label for="newPassword">Nueva contraseña: </label>
        <input type="password" name="newPassword" id="">
        <br>
        <label for="repeatPassword">Repite la nueva contraseña: </label>
        <input type="password" name="repeatPassword" id="">
        <br>
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>