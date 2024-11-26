<?php
    require_once "libros.php";
    $libros = new libros(conexion::getConn(),DB_PREFIX."libros");
    $libro = $libros->getLibro($_GET["id"]);
    if(isset($_POST["Actualizar"])){
        $titulo = conexion::getConn()->quote($_POST["titulo"]);
        $autor = $_POST["autor"];
        $genero = $_POST["genero"];
        $numeroPaginas = $_POST["numeroPaginas"];
        $numeroEjemplares = $_POST["numeroEjemplares"];
        $libros->actualizar($_GET["id"],$titulo, $genero, $autor, $numeroPaginas, $numeroEjemplares);
        header("Location: listadoLibros.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar libro</title>
</head>
<body>
    <h1>Actualizar libro</h1>
    <nav id="menu">
        <ul>
            <li><a href="listadoLibros.php">Listado de libros</a></li>
            <li><a href="listadoAutores.php">Listado de autores</a></li>
            <li><a href="insertarLibro.php">Insertar libro</a></li>
        </ul>
</nav>
    <form action="actualizarLibro.php?id=<?php echo $_GET['id']?>" method="post">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" value='<?php echo $libro['Titulo'];?>'>
        <label for="autor">Autor</label>
        <input type="number" name="autor" id="autor" value='<?php echo $libro['Autor'];?>'>
        <label for="genero">Genero</label>
        <select name="genero" id="genero" value='<?php echo $libro['Genero'];?>'>
            <option value="Narrativa">Narrativa</option>
            <option value="Lirica">Lirica</option>
            <option value="Teatro">Teatro</option>
            <option value="Cientifico-Tecnico">Cientifico-Tecnico</option>
        </select>
        <label for="numeroPaginas">Numero paginas</label>
        <input type="number" name="numeroPaginas" id="numeroPaginas" value='<?php echo $libro['NumeroPaginas'];?>'>
        <label for="numeroEjemplares">Numero ejemplares</label>
        <input type="number" name="numeroEjemplares" id="numeroEjemplares" value='<?php echo $libro['NumeroEjemplares'];?>'>
        <input type="submit" name ="Actualizar" value="Actualizar">
    </form>


</body>
</html>