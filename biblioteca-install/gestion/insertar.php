<?php
    require_once '../config/config.php';
    require_once '../config/templates.php';
    if(isset($_REQUEST['Insertar'])){
        require_once 'libros.php';
        $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        if ($conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error; 
        }
        $datosLibro = [
            'titulo' => $_REQUEST['titulo'],
            'genero' => $_REQUEST['genero'],
            'idAutor' => $_REQUEST['autor'],
            'nPaginas' => $_REQUEST['numPaginas'],
            'nEjemplares' => $_REQUEST['nEjemplares']
        ];
        $libro = new libros($conexion);
        $libro->insertaLibro($datosLibro);
        $mensaje = "Libro insertado correctamente";
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
        <h1>Insertar Libro</h1>
    </header>
    <?php
      
        echo $cabecera;
    ?>
    <form method="POST" action="" >
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo">
        <label for="genero">Genero</label>
         <select name="genero">
            <option>Narrativa</option>
            <option>Lírica</option>
            <option>Teatro</option>
            <option>Científico-Técnico</option>
        </select>
        <label for="autor">Autor</label>
        <select  name="autor" id="autor">
            <?php
                require_once 'autores.php';
                $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
                if ($conexion->connect_errno) {
                    echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error; 
                }
                $autores = new autores($conexion);
                $listaAutores = $autores->consultaAutores();
                foreach($listaAutores as $autor){
                    echo "<option value='$autor[idAutor]'>$autor[Nombre] $autor[Apellidos]</option>";
                }
            ?>
        </select>
        <button style="all:initial;" type="button" onclick="window.location.href='insertarAutor.php'">*</button>

        <label for="numPaginas">Numero de paginas</label>
        <input type="number" name="numPaginas" id="numPaginas">
        <label for="nEjemplares">Numero de ejemplares</label>
        <input type="number" name="nEjemplares" id="nEjemplares">
        <input type="submit" value="Insertar" name="Insertar">
        </form>
        <?php
            if(isset($mensaje)){
                echo "<p>$mensaje</p>";
            }
        ?>
   <?php
       
        echo $pie;
    ?>
</body>
</html>