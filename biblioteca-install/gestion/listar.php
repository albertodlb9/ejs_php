<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado completo libros</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <header>
        <h1>Listado completo de libros</h1>
    </header>
    <div id="Listado">
    <?php
        require_once "../config/config.php";
        require_once "../config/templates.php";
        echo $cabecera;

    ?>
        <table>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Genero</th>
                <th>Autor</th>
                <th>Nº Paginas</th>
                <th>Nº Ejemplares</th>
            </tr>
            <?php
                require_once("libros.php");
                require_once("autores.php");
               
                $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
                if ($conexion->connect_errno) {
                    echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error; 
                }
                $libros = new libros($conexion);
                $todosLosLibros = $libros->consultarLibros();
                $autores = new autores($conexion);
                foreach($todosLosLibros as $libro){
                    echo "<tr>";
                    echo "<td>".$libro['idLibro']."</td>";
                    echo "<td>".$libro['titulo']."</td>";
                    echo "<td>".$libro['genero']."</td>";
                    $autor = $autores->consultaAutores($libro['idAutor'])[0];
                    //print_r($autor);
                   
                    echo "<td>$libro[idAutor]-$autor[Apellidos], $autor[Nombre] </td>";
                    echo "<td>".$libro['numeroPaginas']."</td>";
                    echo "<td>".$libro['numeroEjemplares']."</td>";
                    echo "<td><a href='actualizar.php?idLibro=$libro[idLibro]'>Actualizar</a></td>";
                    echo "<td><a href='borrar.php?idLibro=$libro[idLibro]'>Borrar</a></td>";
                    echo "</tr>";
                }
                unset($autores);
                unset($todosLosLibros);
                $conexion->close();
                
                ?>
        </table>
    </div>
   <?php
        echo $pie;
    ?>
    
</body>
</html>