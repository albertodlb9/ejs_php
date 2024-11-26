<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado libros</title>
</head>
<body>
    <h1>Listado de libros</h1>
    <nav id="menu">
        <ul>
            <li><a href="listadoLibros.php">Listado de libros</a></li>
            <li><a href="listadoAutores.php">Listado de autores</a></li>
            <li><a href="insertarLibro.php">Insertar libro</a></li>
        </ul>
    </nav>
    <table>
        <tr>
            <th>Titulo</th>
            <th>Genero</th>
            <th>Autor</th>
            <th>Numero paginas</th>
            <th>Numero ejemplares</th>
        </tr>
        <?php
            require_once "libros.php";
            $libros = new libros(conexion::getConn(),DB_PREFIX."libros");
            $libros = $libros->consultarTodo();
            foreach($libros as $libro){
                echo "<tr>";
                echo "<td>".$libro["Titulo"]."</td>";
                echo "<td>".$libro["Genero"]."</td>";
                echo "<td>".$libro["idAutor"]."</td>";
                echo "<td>".$libro["NumeroPaginas"]."</td>";
                echo "<td>".$libro["NumeroEjemplares"]."</td>";
                echo "<td><a href='actualizarLibro.php?id=".$libro["id"]."'>Actualizar</a></td>";
                echo "<td><a href='borrarLibro.php?id=".$libro["id"]."'>Borrar</a></td>";
                echo "</tr>";
            }
        ?>
        
    </table>
</body>
</html>