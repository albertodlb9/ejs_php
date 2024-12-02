<?php
    require_once "seguridad.php";
    require_once 'conexion.php';
    require_once 'libros.php';
    $seguridad = new Seguridad();
    if(!$seguridad->acceso("bibliotecario")){
        header('Location: index.php');
    }
    if(!isset($_GET['id'])){
        header('Location: listadoLibros.php');
    }
    $libros = new libros(conexion::getConn(), 'libros');
    if(isset($_GET['id'])){
        $libro=$libros->getLibro($_GET['id']);
    }
    if(isset($_POST['Actualizar'])){
        $libros->actualizar($_POST['id'], $_POST['titulo'], $_POST['genero'], $_POST['autor'], $_POST['nPaginas'], $_POST['nEjemplares']);
        header('Location: listadoLibros.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Libro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        if(isset($_SESSION['rol'])){
            $usuario = $_SESSION['usuario'];
            echo "<p><strong>$usuario</strong>  <a href='cerrarSesion.php'>Cerrar sesion</a></p>";
        }
    ?>
    <h1>Actualizar libro</h1>
    <nav id='menu'>
        <ul>
        <li><a href="listadoLibros.php">Listado de libros</a></li>
        <li><a href="listadoAutores.php">Listado de autores</a></li>
        <li><a href="insertarLibro.php">Insertar libro</a></li>
        </ul>
   
        </nav>
    <form action="actualizarLibro.php" method="post">
        <input type="hidden" name="id" value='<?php echo $libro['idLibro'];?>'>
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" value='<?php echo $libro['titulo'];?>'>
        <br>
        <label for="autor">Autor</label>
        <select name="autor" id="autor">
            <?php
            require_once 'autores.php';
            $autores = new autores(conexion::getConn(), 'autores');
            $listaAutores = $autores->listar();
            foreach($listaAutores as $autor){
                echo "<option value='".$autor['idAutor']."'";
                if($autor['idAutor']==$libro['idAutor']){
                    echo "selected";
                }
                echo ">".$autor['Nombre']." ".$autor['Apellidos']."</option>";
            }
            ?>
        </select>
        <br>
        <label for="genero">Genero</label>
        <select id="genero" name="genero">
            <option value="Narrativa" <?php if($libro["genero"] == "Narrativa"){echo "selected";} ?>>Narrativa</option>
            <option value="Lírica" <?php if($libro["genero"] == "Lírica"){echo "selected";} ?>>Lírica</option>
            <option value="Teatro" <?php if($libro["genero"] == "Teatro"){echo "selected";} ?>>Teatro</option>
            <option value="Científico-Técnico" <?php if($libro["genero"] == "Científico-Técnico"){echo "selected";} ?>>Científico-Técnico</option>
        </select>
        <br>
        <label for="nPaginas">Número de páginas</label>
        <input type="number" name="nPaginas" id="nPaginas"
        value='<?php echo $libro['numeroPaginas'];?>'>
        <br>
        <label for="nEjemplares">Número de ejemplares</label>
        <input type="number" name="nEjemplares" id="nEjemplares"
        value='<?php echo $libro['numeroEjemplares']; ?>'>
        <br>
        <input type="submit" name="Actualizar" value="Actualizar">
    
    </form>
    <?php 
    if(isset($mensaje))
      echo "<p class='error'>".$mensaje."</p>";  
    ?>
    <footer>
        <p>Desarrollado por: <a href="">Alberto de la blanca</a></p>
    </footer>
    
</body>
</html>