<?php
    if(!file_exists('./install/config.php')){
        header('Location: ./install/install.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca 1.0</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
        <?php
        if(isset($_GET['msg'])){
            echo "<h2 class = 'instalacion'>".$_GET['msg']."</h2>";
        }
        ?>
        <h1>Bienvenido a la biblioteca 1.0</h1>

        <nav id='menu'>
        <a href="listadoLibros.php">Listado de libros</a>
        <a href="listadoAutores.php">Listado de autores</a>
        <a href="insertarLibro.php">Insertar libro</a>
        </nav>
    <footer>
        <p>Desarrollado por: <a href="">@Alberto de la blanca</a></p>
    </footer>
</body>
</html>