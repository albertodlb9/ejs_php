<?php
    if(file_exists('config.php') && filesize('config.php') > 0){
        header('Location: index.php');
    }
    if($_POST["instalar"] && is_writable('./')){
        $mensaje = "";
        $instalacion = true;
        $error = false;
        try{
            $host = $_POST["host"];
            $user = $_POST["user"];
            $password = $_POST["password"];
            $database = $_POST["database"];
            $port = $_POST["port"];

            $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);

            $nombre = $_POST["admin_name"];
            $apellidos = $_POST["admin_apellido"];
            $login = $_POST["admin"];
            $admin_password = $_POST["admin_password"];
            $salt = random_int(10000000,99999999);
            $admin_password = password_hash($admin_password.$salt, PASSWORD_DEFAULT);
            $ruta = $_FILES["admin_avatar"]["tmp_name"];
            $tipo = $_FILES["admin_avatar"]["type"];
            $tam = $_FILES["admin_avatar"]["size"];
            $destino = "./imagenes/".$login;
            if(move_uploaded_file($ruta, $destino) && $tam < 1000000){
                $avatar = $destino;

                $sql['usuarios'] = <<<SQL
                    CREATE TABLE IF NOT EXISTS usuarios(
                    nombre VARCHAR(50) NOT NULL,
                    apellidos VARCHAR(100) NOT NULL,
                    login VARCHAR(50) NOT NULL PRIMARY KEY,
                    password VARCHAR(255) NOT NULL,
                    salt VARCHAR(8) NOT NULL,
                    avatar VARCHAR(255) NOT NULL,
                    rol ENUM('administrador','registrado','bibliotecario') NOT NULL DEFAULT 'registrado'
                    )ENGINE=InnoDB DEFAULT CHARSET=utf8;
                SQL;
                $sql['insert_admin'] = <<<SQL
                    INSERT INTO usuarios(nombre,apellidos,login,password,salt,avatar,rol)
                    VALUES('$nombre','$apellidos','$login','$admin_password',$salt,'$avatar','administrador');
                SQL;
                $sql['autores']=<<<SQL
                    CREATE TABLE  IF NOT EXISTS `autores` (
                    `idAutor` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    `Nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                    `Apellidos` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
                    `Pais` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de autores ';
                SQL;
                $sql['libros']=<<<SQL
                    CREATE TABLE `libros` (
                    `idLibro` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT  'Clave primaria de la tabla',
                    `titulo` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
                    `genero` enum('Narrativa','Lírica','Teatro','Científico-Técnico') COLLATE utf8mb4_unicode_ci NOT NULL,
                    `idAutor` int UNSIGNED DEFAULT NULL COMMENT 'Será una clave foránea de la tabla auores',
                    `numeroPaginas` int UNSIGNED NOT NULL,
                    `numeroEjemplares` int UNSIGNED NOT NULL,
                    FOREIGN KEY (`idAutor`) REFERENCES `autores` (`idAutor`) ON DELETE SET NULL ON UPDATE CASCADE
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de libros de nuestra biblioteca';
                SQL;

                foreach($sql as $clave => $valor){
                    try{
                        $sentencia = $conn->prepare($valor);
                        $sentencia->execute();
                    }catch(PDOException $e){
                        $error = true;
                        $mensaje = $e->getMessage();
                    }
                }
                if($error){
                    $instalacion = false;
                } else{
                    $config = <<<CONFIG
                    <?php
                        define('DB_HOST', '$host');
                        define('DB_USER', '$user');
                        define('DB_PASSWORD', '$password');
                        define('DB_NAME', '$database');
                        define('DB_PORT', '$port');
                        define('DB_DRIVER', 'mysql');
                    ?>
                    CONFIG;

                    $fp = fopen('config.php', 'w');
                    fwrite($fp, $config);
                    fclose($fp);
                    header('Location: index.php?msg=Instalacion correcta');
                } 
            }else{
                $mensaje = "La imagen no es correcta";
            } 
        }catch(PDOException $e){
            $mensaje = $e->getMessage();
            $instalacion = false;
        }
        
    }else{
        $mensaje = "No se puede escribir en el directorio";
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalacion</title>
    <link rel="stylesheet" href="style.css">
    <link type="image/png" sizes="16x16" rel="icon" href="./imagenes/icons8-libro-16.png">
</head>
<body>
    <h1>Instalacion de la aplicacion</h1>
    <h3>Requisitos para realizar la instalación:</h3>
    <ol>
        <li>IP o nombre del host para el sistema gestor de bases de datos MariaDB o Mysql</li>
        <li>Usuario con privilegios sobre una base de datos en ese SGBD</li>
        <li>Contraseña del usuario</li>
        <li>Nombre de la base de datos</li>
        <li>Puerto de conexión a esa base de datos (si no es el estándar)</li>
    </ol>
    
    <form action="install.php" method="post" enctype="multipart/form-data">
        <h3>Datos del SGDB:</h3>
        <label for="host">Host:</label>
        <input type="text" name="host" id="host" required>
        <br>
        <label for="user">Usuario:</label>
        <input type="text" name="user" id="user" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="database">Base de datos:</label>
        <input type="text" name="database" id="database" required>
        <br>
        <label for="port">Puerto:</label>
        <input type="number" name="port" id="port" value="3306">
        <br>
        <h3>Datos del administrador:</h3>
        <label for="admin_avatar">Avatar:</label>
        <input type="file" name="admin_avatar" id="admin_avatar" required>
        <br>
        <label for="admin_name">Nombre:</label>
        <input type="text" name="admin_name" id="admin_name" required>
        <br>
        <label for="admin_apellido">Apellido:</label>
        <input type="text" name="admin_apellido" id="admin_apellido" required>
        <br>
        <label for="admin">Usuario:</label>
        <input type="text" name="admin" id="admin" required>
        <br>
        <label for="admin_password">Contraseña:</label>
        <input type="password" name="admin_password" id="admin_password" required>
        <br>
        <input type="submit" name ="instalar" value="Instalar">
    </form>

    <?php
        if(!$instalacion && isset($_POST["instalar"])){
            echo "<h2>Instalación fallida</h2>";
            echo "<p>$mensaje</p>";
        }
    ?>

</body>
</html>