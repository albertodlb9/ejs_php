<?php
    require_once '../config/config.php';
    require_once '../config/templates.php';

    if(isset($_REQUEST['Insertar'])){

        require_once 'autores.php';
        $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        if ($conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error; 
        }
        $datosAutor = [
            'Nombre' => $_REQUEST['Nombre'],
            'Apellidos' => $_REQUEST['Apellidos'],
            'Pais' => $_REQUEST['Pais']
        ];
        $autor = new autores($conexion);
        if($autor->insertaAutor($datosAutor)){
            $mensaje = "Autor insertado correctamente";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Libro</title>
    <link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
    <header>
        <h1>Insertar Autor</h1>
    </header>
    <?php
        include_once 'config.php';
        echo $cabecera;
    ?>
    <form method="POST" action="" >
        <label for="Nombre">Nombre</label>
        <input type="text" name="Nombre" id="Nombre">
        <label for="Apellidos">Apellidos</label>
        <input type="text" name="Apellidos" id="Apellidos">
        <label for="Pais">País</label>
        <input type="text" name="Pais" id="Pais">
        <input type="submit" value="Insertar" name="Insertar">
        </form>
        <?php
            if(isset($mensaje)){
                echo "<p>$mensaje</p>";
            }
        ?>
   <?php
        include_once 'config.php';
        echo $pie;
    ?>
</body>
</html>