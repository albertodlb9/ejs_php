<?php
    require_once '../config/config.php';
    require_once '../config/templates.php';
    if(isset($_REQUEST['Busca'])){

        require_once 'libros.php';
        require_once 'autores.php';
        $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        if ($conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error; 
        }
        
        $biblioteca = new libros($conexion);
        $busqueda=$biblioteca->consultarLibros(NULL,$_REQUEST['titulo'],$_REQUEST['genero'],$_REQUEST['autor'],$_REQUEST['numPaginas'],$_REQUEST['nEjemplares']);
        $autores = new autores($conexion);
        
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Libro</title>
    <link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
    <header>
        <h1>Buscar Libros</h1>
    </header>
    <?php

        echo $cabecera;
    ?>
    <form method="POST" action="" >
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo">
        <label for="genero">Genero</label>
         <select name="genero">
            <option>Narrativa</option>
            <option>Lírica</option>
            <option>Teatro</option>
            <option>Científico-Técnico</option>
        </select>
        <label for="autor">Autor</label>
        <select  name="autor" id="autor">
            <?php
                require_once 'autores.php';
                $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
                if ($conexion->connect_errno) {
                    echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error; 
                }
                $autores = new autores($conexion);
                $listaAutores = $autores->consultaAutores();
                foreach($listaAutores as $autor){
                    echo "<option value='$autor[idAutor]'>$autor[Nombre] $autor[Apellidos]</option>";
                }
                
            ?>
        </select>

        <label for="numPaginas">Numero de paginas</label>
        <input type="number" name="numPaginas" id="numPaginas">
        <label for="nEjemplares">Numero de ejemplares</label>
        <input type="number" name="nEjemplares" id="nEjemplares">
        <input type="submit" value="Busca" name="Busca">
        </form>
        <table>
                <th>Id</th>
                <th>Titulo</th>
                <th>Genero</th>
                <th>Autor</th>
                <th>Nº Paginas</th>
                <th>Nº Ejemplares</th>
            </tr>
        <?php
            if(isset($busqueda)){
              
                foreach($busqueda as $libro){
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
            }
        ?>
        </table>
   <?php

        echo $pie;
    ?>
</body>
</html>