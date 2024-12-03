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
            $password = $_POST['contraseña'];
            $contraseña = password_hash($password.$salt, PASSWORD_DEFAULT);
        }else{
            $contraseña = $password;     
        }
        if(isset($_FILES["avatar"] ) && $_FILES["avatar"]["error"] == UPLOAD_ERR_OK){    
            $ruta = $_FILES["avatar"]["tmp_name"];
            $tipo = $_FILES["avatar"]["type"];
            $tam = $_FILES["avatar"]["size"];
            $destino = "./imagenes/".$nuevoLogin;
            if(move_uploaded_file($ruta, $destino) && $tam < 1000000){
                $avatar = $destino;
                $usuario = new usuario(conexion::getConn());
                $usuario->modificar($nombre, $apellidos, $login, $nuevoLogin, $contraseña,$avatar, $rol);
                header('Location: gestionUsuarios.php?msg=Usuario modificado correctamente');
            }else{
                header('Location: gestionUsuarios.php?err=Error al modificar el usuariomiau');
            }
        }else{
            $avatar = "./imagenes/".$nuevoLogin;
            $usuario = new usuario(conexion::getConn());
            rename("./imagenes/".$login, $avatar);
            $usuario->modificar($nombre, $apellidos, $login, $nuevoLogin, $contraseña ,$avatar, $rol);
            header('Location: gestionUsuarios.php?msg=Usuario modificado correctamente');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modificar usuario</title>
</head>
<body>
    <h1>Modificar usuario</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="avatar">Avatar:</label>
            <input type="file" name="avatar" id="">
            <br>
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