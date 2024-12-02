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
            header("Location: index.php?msg=El cambio de password se realizo correctamente");
        }else{
            header("Location: index.php?err=El cambio de password ha fallado");

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cambiar contraseña</h1>
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
        <input type="submit" value="enviar" name="enviar">
    </form>
</body>
</html>