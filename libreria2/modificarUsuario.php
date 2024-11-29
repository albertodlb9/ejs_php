<?php
    require_once 'seguridad.php';
    $seguridad = new Seguridad();
    if(!$seguridad->acceso('administrador')){
        header('Location: index.php');
    }
    if(isset($_GET['login'])){
        require_once 'usuarios.php';
        require_once 'conexion.php';
        $usuario = new usuario(conexion::getConn());
        $login = $_GET['login'];
        $datos = $usuario->buscar($login);
        $nombre = $datos['nombre'];
        $apellidos = $datos['apellidos'];
        $rol = $datos['rol'];
        $salt = $datos['salt'];
        $password = $datos['password'];
    }
    if(isset($_POST['enviar'])){
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $nuevoLogin = $_POST['login'];
        $rol = $_POST['rol'];
        if($_POST['contraseña'] != ''){
            $contraseña = $_POST['contraseña'];
            $password = password_hash($password.$salt, PASSWORD_DEFAULT);
        }else{
            $contraseña= $password;
        }
        $usuario = new usuario(conexion::getConn());
        $usuario->modificar($nombre, $apellidos, $login, $nuevoLogin, $password, $rol);
        header('Location: gestionUsuarios.php');
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

        <form action="" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required>
            <br>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>" required>
            <br>
            <label for="login">Usuario:</label>
            <input type="text" name="login" id="login" value="<?php echo $login; ?>" required>
            <br>
            <?php
                if($rol !="administrador"){
            ?>
            <label for="rol">Rol:</label>
            <select name="rol" id="rol">
                <option value="registrado" <?php if($rol == 'registrado'){echo 'selected';} ?>>Registrado</option>
                <option value="bibliotecario" <?php if($rol == 'bibliotecario'){echo 'selected';} ?>>Bibliotecario</option>
                <option value="administrador" <?php if($rol == 'administrador'){echo 'selected';} ?>>Administrador</option>
            </select>
            <br>
            <?php
                }else{
                    echo "<input type='hidden' name='rol' value='administrador'>";
                    echo "<br>";
                }
            ?>
            <label for="contraseña">Contraseña:</label>
            <input type="password" name="contraseña" id="contraseña">
            <br>
            <input type="submit" value="Modificar" name="enviar">
        </form>

</body>
</html>