<?php
        require_once '../config/config.php';
        require_once '../config/templates.php';
        require_once 'libros.php';
        $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        if ($conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error; 
        }
        $libro = new libros($conexion);
        $datosLibro = $libro->consultarLibros($_REQUEST['idLibro'])[0];

    if(isset($_REQUEST['Actualizar'])){

        $datosLibro = [
            'idLibro' => $_REQUEST['idLibro'], // <--- This is the new line
            'titulo' => $_REQUEST['titulo'],
            'genero' => $_REQUEST['genero'],
            'idAutor' => $_REQUEST['autor'],
            'nPaginas' => $_REQUEST['numPaginas'],
            'nEjemplares' => $_REQUEST['nEjemplares']
        ];
        $libro->actualizaLibro($datosLibro);

        header("Location: listar.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Libro</title>
    <link rel="stylesheet" href="../css/estilo.css">
      

</head>
<body>
    <header>
        <h1>Actualizar Libro</h1>
    </header>
    <?php
        echo $cabecera;
    ?>
 
    <form method="POST" action="" >
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" 
        value="<?php echo "$datosLibro[titulo]";?>">
        <label for="genero">Genero</label>
         <select name="genero">
            <option><?php echo "$datosLibro[genero]";?></option>
            <option>Narrativa</option>
            <option>Lírica</option>
            <option>Teatro</option>
            <option>Científico-Técnico</option>
        </select>
        <label for="autor">Autor</label>
        <input type="text" name="autor" id="autor"
        value="<?php echo "$datosLibro[idAutor]";?>">
        <label for="numPaginas">Numero de paginas</label>
        <input type="number" name="numPaginas" id="numPaginas"
        value="<?php echo "$datosLibro[numeroPaginas]";?>">
        <label for="nEjemplares">Numero de ejemplares</label>
        <input type="number" name="nEjemplares" id="nEjemplares"
        value="<?php echo "$datosLibro[numeroEjemplares]";?>">
        <input type="submit" value="Actualizar" name="Actualizar">
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