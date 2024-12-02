<?php
    require_once 'seguridad.php';
    $seguridad = new Seguridad();
    if(!$seguridad->acceso('administrador', 'bibliotecario', "registrado")){
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de libros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php
        if(isset($_SESSION['rol'])){
            $usuario = $_SESSION['usuario'];
            echo "<p><strong>$usuario</strong>  <a href='cerrarSesion.php'>Cerrar sesion</a></p>";
            echo "<h1>Listado de libros</h1>";
    ?>
    <nav id='menu'>    
    <?php
        if($_SESSION['rol'] == 'administrador' || $_SESSION['rol'] == 'bibliotecario'){
    ?>
    <a href="listadoAutores.php">Listado de autores</a>
    <a href="insertarLibro.php">Insertar libro</a>
    <?php
            if($_SESSION['rol'] == 'administrador'){
    ?>
    <a href="gestionarUsuarios.php">Gestion de usuarios</a>
    <?php
            }
        }
    ?>
    </nav>
    <?php
        }
    ?>
<table>
    <tr>
        <th>Titulo</th>
        <th>Genero</th>
        <th>Autor</th>
        <th>Número de páginas</th>
        <th>Número de ejemplares</th>
    </tr>

    <?php
    require_once 'libros.php';
    require_once 'conexion.php';
    require_once 'autores.php';
    $libros = new libros(conexion::getConn(), 'libros');
    $autores = new autores(conexion::getConn(), 'autores');
    $listado = $libros->listar();
    foreach($listado as $libro){
        $autor = $autores->getAutor($libro['idAutor']);
        echo "<tr>";
        echo "<td>".$libro['titulo']."</td>";
        echo "<td>".$libro['genero']."</td>";
        echo "<td>$autor[Nombre] $autor[Apellidos]</td>";
        echo "<td>".$libro['numeroPaginas']."</td>";
        echo "<td>".$libro['numeroEjemplares']."</td>";
        echo "<td><a href='actualizarLibro.php?id=".$libro['idLibro']."'>Actualizar</a></td>";
        echo "<td><a href='borrarLibro.php?id=".$libro['idLibro']."'>Borrar</a></td>";
        echo "</tr>";
    }
    ?>
</table>
<footer>
    <p>Desarrollado por: <a href="">Alberto de la Blanca</a></p>    
</footer>
</body>
