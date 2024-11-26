

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de libros</title>
    <link rel="stylesheet" href="../ejercicios.css">
</head>
<body>
    <h1>Listado</h1>
    <nav id='menu'>
        <a href="listadoLibros.php">Listado de libros</a>
        <a href="listadoAutores.php">Listado de autores</a>
        <a href="insertarLibro.php">Insertar libro</a>
  
    </nav>
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
        echo "<td>".$libro['Titulo']."</td>";
        echo "<td>".$libro['Genero']."</td>";
        echo "<td>$autor[Nombre] $autor[Apellidos]</td>";
        echo "<td>".$libro['NumeroPaginas']."</td>";
        echo "<td>".$libro['NumeroEjemplares']."</td>";
        echo "<td><a href='actualizarLibro.php?id=".$libro['id']."'>Actualizar</a></td>";
        echo "<td><a href='borrarLibro.php?id=".$libro['id']."'>Borrar</a></td>";
        echo "</tr>";
    }
    ?>
</table>
<footer>
    <p>Desarrollado por: <a href="">@mvaronc</a></p>    
</footer>
</body>
