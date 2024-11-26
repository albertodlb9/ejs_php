<?php
    require_once 'autores.php';
    require_once 'conexion.php';
    $autores = new autores(conexion::getConn(), 'autores');
    if(isset($_POST['Insertar'])){
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $nacionalidad = $_POST['nacionalidad'];
        $idAutor=$autores->insertar($nombre, $apellidos, $nacionalidad);
        if($idAutor){
            header('Location: listadoAutores.php');
        }else{
            $mensaje = "Error al insertar el autor".       
            "<br>".conexion::getConn()->errorInfo()[2];
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar autor</title>
    <link rel="stylesheet" href="../ejercicios.css">
</head>
<body>
    <h1>Insertar autor</h1>
    <nav id='menu'>
        <a href="listadoLibros.php">Listado de libros</a>
        <a href="listadoAutores.php">Listado de autores</a>
        <a href="insertarLibro.php">Insertar libro</a>
    </nav>
    <form action="insertarAutor.php" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos">
        <label for="nacionalidad">Nacionalidad</label>
        <input type="text" name="nacionalidad" id="nacionalidad">
        <input type="submit" name="Insertar" value="Insertar">
    </form>
    <?php
    if(isset($mensaje))
        echo "<p class='error'>".$mensaje."</p>";
    ?>


    <footer>
        <p>Desarrollado por: <a href="">Alberto de la blanca</a></p>    
    </footer>
</body>