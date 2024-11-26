<?php
    require_once "configDB.php";
    require_once "users.php";
    if(isset($_POST["enviar"])){
        $login = $_POST["login"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $apellido1 = $_POST["apellido1"];
        $apellido2 = $_POST["apellido2"];
        $ruta = $_FILES["avatar"]["tmp_name"];
        $tipo = $_FILES["avatar"]["type"];

        $destino = "./imagenes/".$login;

        if($tipo != "image/jpeg" && $tipo != "image/png"){
            $mensaje =  "El tipo de archivo no es correcto";
        }else{
            if(move_uploaded_file($ruta,$destino)){
                try{
                    $conexion = new PDO($DBDriver.":host=".$DBHost.";dbname=".$DBName, $DBUser,$DBPassword);
                    $user = new users($conexion);
                    $user->insertar($login,$password,$name,$apellido1,$apellido2,$destino);
                    $mensaje = "Registro completado";
                }catch(PDOException $e){
                    $mensaje = "Error al conectar con la base de datos";
                }
            } else{
                $mensaje =  "Ocurrio algun error al subir el fichero.";
            }
        }
        header("Location: insertado.php?mensaje=$mensaje");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar usuario</title>
</head>
<body>
    <h1>Insertar usuario</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="login">Login</label>
        <br>
        <input type="text" name="login">
        <br>
        <label for="password">Password</label>
        <br>
        <input type="password" name="password" id="">
        <br>
        <label for="name">Nombre</label>
        <br>
        <input type="text" name="name" id="">
        <br>
        <label for="apellido1">Apellido 1</label>
        <br>
        <input type="text" name="apellido1" id="">
        <br>
        <label for="apellido2">Apellido 2</label>
        <br>
        <input type="text" name="apellido2" id="">
        <br>
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" id="">
        <br>
        <input type="submit" value="Enviar" name="enviar">
    </form>

    <a href="listado.php">Ver el listado de usuarios</a>
    <br>
    <?php
        if(isset($_GET["mensaje"])){
            echo "<p>".$_GET["mensaje"]."</p>";
        }
    ?>
</body>
</html>