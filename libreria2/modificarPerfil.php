<?php
    require_once 'seguridad.php';
    $seguridad = new Seguridad();
    if(!$seguridad->acceso('registrado', 'bibliotecario', 'administrador')){
        header('Location: index.php');
    }

    if(isset($_POST['modificar'])){
        require_once 'usuarios.php';
        require_once 'conexion.php';
        $usuario = new usuario(conexion::getConn());
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $login = $_POST['usuario'];
        $busqueda = $usuario->buscar($_SESSION['usuario']);
        $password = $busqueda['password'];
        if(isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == UPLOAD_ERR_OK){    
            $ruta = $_FILES["avatar"]["tmp_name"];
            $tipo = $_FILES["avatar"]["type"];
            $tam = $_FILES["avatar"]["size"];
            $destino = "./imagenes/".$login;
            $avatar = $destino;
            if(move_uploaded_file($ruta, $avatar) && $tam < 1000000){    
                try{
                    unlink("./imagenes/".$_SESSION['usuario']);
                    $modificar = $usuario->modificar($nombre, $apellidos, $_SESSION['usuario'], $login, $password, $avatar, $_SESSION['rol']);
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['apellidos'] = $apellidos;
                    $_SESSION['usuario'] = $login;
                    header('Location: modificarPerfil.php?msg=Datos modificados correctamente');
                }catch(Exception $e){
                    $error = $e->getMessage();
                    header('Location: modificarPerfil.php?err='.$error);
                }
            }else{
                header('Location: modificarPerfil.php?err=Error al modificar los datos');
            }
        }else{           
            $avatar = "./imagenes/".$login;
            rename("./imagenes/".$_SESSION['usuario'], $avatar);
            try{
                $modificar = $usuario->modificar($nombre, $apellidos, $_SESSION['usuario'], $login, $password, $avatar, $_SESSION['rol']);
                $_SESSION['nombre'] = $nombre;
                $_SESSION['apellidos'] = $apellidos;
                $_SESSION['usuario'] = $login;
                header('Location: modificarPerfil.php?msg=Datos modificados correctamente');
            }catch(Exception $e){
                $error = $e->getMessage();
                header('Location: modificarPerfil.php?err='.$error);
            }
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
    <link rel="stylesheet" href="style.css">
    <link type="image/png" sizes="16x16" rel="icon" href="./imagenes/icons8-libro-16.png">
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
    <h1>Mis datos</h1>
    <nav>
        <ul>
            <li><a href="index.php">Volver al inicio</a></li>
        </ul>
    </nav>
    <form action="" method="post" enctype="multipart/form-data">
        <img  width="100px" <?php echo "src='./imagenes/".$_SESSION["usuario"]."'" ?> alt="">
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" id="avatar"> 
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $_SESSION['nombre']?>">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" value="<?php echo $_SESSION['apellidos']?>">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario" value="<?php echo $_SESSION['usuario']?>">
        <input type="submit" name="modificar" value="Modificar">
    </form>
</body>
</html>