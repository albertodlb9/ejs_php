<?php
    require_once "autores.php";
    require_once "conexion.php";

    if(isset($_POST["Insertar"])){
        try{
            $conn = conexion::getConn();
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $pais = $_POST["pais"];
            $autores = new autores($conn,DB_PREFIX."autores");
            $autores->insertar($nombre,$apellidos,$pais);
            header("Location: listadoAutores.php");
        }
        catch(PDOException $e){
            echo("Error al conectar con la base de datos: ".$e->getMessage());
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Autor</title>
</head>
<body>
    <h1>Insertar Autor</h1>
    <nav id="menu">
        <ul>
            <li><a href="listadoLibros.php">Listado de libros</a></li>
            <li><a href="listadoAutores.php">Listado de autores</a></li>
            <li><a href="insertarLibro.php">Insertar libro</a></li>
        </ul>
        <form action="insertarAutores.php" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos">
            <label for="pais">Pais</label>
            <input type="text" name="pais" id="pais">
            <input type="submit" name="Insertar" value="Insertar">
        </form>
</nav>
</body>
</html>