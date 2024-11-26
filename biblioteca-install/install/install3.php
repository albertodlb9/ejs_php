<?php
    $procediendo=false;
    $error=false;
    if(isset($_REQUEST['proceder'])){
        $procediendo=true;
        require_once '../config/config.php';
        $conexion = new mysqli(HOST,USUARIO,PASSWORD,BASEDATOS,PUERTO);
        $nombre = $conexion->real_escape_string($_REQUEST['nombre']); 
        $apellidos = $conexion->real_escape_string($_REQUEST['apellidos']);
        $login = $conexion->real_escape_string($_REQUEST['login']);
        $password = $conexion->real_escape_string($_REQUEST['password']);
        $salt=random_int(10000000,99999999);
        $password = password_hash($password.$salt,PASSWORD_DEFAULT);
        
        $sql['usuarios'] = <<<SQL
            CREATE TABLE IF NOT EXISTS usuarios(
                nombre VARCHAR(50) NOT NULL,
                apellidos VARCHAR(100) NOT NULL,
                login VARCHAR(50) NOT NULL PRIMARY KEY,
                password VARCHAR(255) NOT NULL,
                salt VARCHAR(8) NOT NULL,
                rol ENUM('administrador','usuario') NOT NULL DEFAULT 'usuario'
            )ENGINE=InnoDB DEFAULT CHARSET=utf8;
        SQL;
        $sql['insert_admin'] = <<<SQL
            INSERT INTO usuarios(nombre,apellidos,login,password,salt,rol)
            VALUES('$nombre','$apellidos','$login','$password',$salt,'administrador');
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
        $mensaje = "";
        foreach($sql as $clave=>$consulta){
            try{
                $conexion->query($consulta);
                $mensaje .= "<p class='exito'>La tabla o la ejecución $clave se ha creado correctamente</p>";
            }catch(Exception $e){
                $mensaje .= "<p class='error'>Ha habido un error en la creación de la tabla o ejecución $clave</p>
                <p>Inténtelo de nuevo</p> ";
                $error=true;
                
            }
        }
        if(!$error){
            $mensaje.="<p class='exito'>La instalación se ha realizado correctamente</p>";
            $mensaje.="<p>Puede proceder a borrar la carpeta install</p>";
            $mensaje.="<p>Ya puede acceder a la aplicación</p>";
            $mensaje.="<a href='../index.php'>Ir a la aplicación</a>";
     } 
        
    }else{
    if(file_exists("../config/config.php")){
        require_once '../config/config.php';
        if($conexion=new mysqli(HOST,USUARIO,PASSWORD,BASEDATOS,PUERTO)){
            $mensaje= "<p>La conexión se ha realizado correctamente</p>
            <p>Procede a crear las tablas de la base de datos y el primer usuario admnistrador</p>";
        }else{
            header("Location: install2.php");
        }
        
    }else{
        header("Location: ../index.php");
    }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Instalación Aplicación Biblioteca</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <script>
        function muestra(elemento){
            if(elemento.type=="password"){
                elemento.type="text";
            }else{
                elemento.type="password";
            }
            return false;
        }
    </script>
</head>
<body>
    <h1>Instalación Aplicación Biblioteca</h1>
    <?php
       
       if(isset($mensaje)){
            echo $mensaje;
       }
       if($procediendo==false){
    ?>
    <form action="" method="post" onsubmit="">
        <fieldset>
            <legend>Primer usuario administrador</legend>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required><br>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" required><br>
            <label for="login">login</label>
            <input type="text" name="login" id="login" required><br>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required><button onclick="return muestra(this.previousSibling);">&#128065;</button><br>
            <input type="submit" name="proceder" value="proceder">

        </fieldset>
    </form>
    <?php
       }//fin if procediendo
     
    ?>
    <footer> <p>Biblioteca version 1.0 </p>
    
    </footer>
</body>
</html>
