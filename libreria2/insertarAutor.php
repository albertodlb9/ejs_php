<?php
    require_once 'autores.php';
    require_once 'conexion.php';
    require_once "seguridad.php";
    $seguridad = new Seguridad();
    if(!$seguridad->acceso("bibliotecario")){
        header('Location: index.php');
    }
    $autores = new autores(conexion::getConn(), 'autores');
    if(isset($_POST['Insertar'])){
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $nacionalidad = $_POST['nacionalidad'];
        $idAutor=$autores->insertar($nombre, $apellidos, $nacionalidad);
        if($idAutor){
            header('Location: insertarLibro.php');
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
    <link rel="stylesheet" href="style.css">
    <link type="image/png" sizes="16x16" rel="icon" href="./imagenes/icons8-libro-16.png">
</head>
<body>
    <?php
        if(isset($_SESSION['rol'])){
            $usuario = $_SESSION['usuario'];
            echo "<p><strong>$usuario</strong>  <a href='cerrarSesion.php'>Cerrar sesion</a></p>";
        }
    ?>
    <h1>Insertar autor</h1>
    <nav id='menu'>
        <ul>
        <li><a href="listadoLibros.php">Listado de libros</a></li>
        <li><a href="listadoAutores.php">Listado de autores</a></li>
        </ul>
    </nav>
    <form action="insertarAutor.php" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos">
        <br>
        <label for="nacionalidad">Nacionalidad</label>
        <input type="text" name="nacionalidad" id="nacionalidad">
        <br>
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