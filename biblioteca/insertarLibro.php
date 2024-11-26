<?php
    require_once "libros.php";
    try{
        $libros = new libros(conexion::getConn(),DB_PREFIX."libros");
        if(isset($_POST["titulo"])){
            $titulo = conexion::getConn()->quote($_POST["titulo"]);
            $autor = $_POST["autor"];
            $genero = $_POST["genero"];
            $numeroPaginas = $_POST["numeroPaginas"];
            $numeroEjemplares = $_POST["numeroEjemplares"];
            $libros->insertar($titulo, $genero, $autor, $numeroPaginas, $numeroEjemplares);
            header("Location: insertarLibro.php");
        }
    }catch(PDOException $e){
    echo("Error al conectar con la base de datos: ".$e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar libro</title>
</head>
<body>
    <h1>Insertar libro</h1>
    <nav id="menu">
        <ul>
            <li><a href="listadoLibros.php">Listado de libros</a></li>
            <li><a href="listadoAutores.php">Listado de autores</a></li>
            <li><a href="insertarLibro.php">Insertar libro</a></li>
        </ul>
</nav>
    <form action="insertarLibro.php" method="post">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo">
        <label for="autor">Autor</label>
        <select name="autor" id="autor">
            <?php
                require_once "autores.php";
                $autores = new autores(conexion::getConn(),DB_PREFIX."autores");
                $autores = $autores->consultarTodo();
                foreach($autores as $autor){
                    echo "<option value='".$autor["id"]."'>".$autor["Nombre"]." ".$autor["Apellidos"]."</option>";
                }
            ?>
        </select>
        <button><a href="insertarAutores.php">Insertar autor</a></button>
        <label for="genero">Genero</label>
        <select name="genero" id="genero">
            <option value="Narrativa">Narrativa</option>
            <option value="Lirica">Lirica</option>
            <option value="Teatro">Teatro</option>
            <option value="Cientifico-Tecnico">Cientifico-Tecnico</option>
        </select>
        <label for="numeroPaginas">Numero paginas</label>
        <input type="number" name="numeroPaginas" id="numeroPaginas">
        <label for="numeroEjemplares">Numero ejemplares</label>
        <input type="number" name="numeroEjemplares" id="numeroEjemplares">
        <input type="submit" value="Insertar">
    </form>


</body>
</html>