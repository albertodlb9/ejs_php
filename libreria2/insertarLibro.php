<?php
    require_once 'seguridad.php';
    $seguridad = new Seguridad();
    if(!$seguridad->acceso('bibliotecario')){
        header('Location: index.php');
    }

    require_once 'libros.php';
    require_once 'conexion.php';
    
    if(isset($_POST['Insertar'])){
        $libros = new libros(conexion::getConn(), 'libros');
        $titulo = $_POST['titulo'];
        $autor = intval($_POST['autor']);
        $genero = $_POST['genero'];
        $nPaginas = $_POST['nPaginas'];
        $nEjemplares = $_POST['nEjemplares'];
        $idLibro=$libros->insertar($titulo, $genero, $autor, $nPaginas, $nEjemplares);
        if($idLibro){
         header('Location: listadoLibros.php');
        }else{
            $mensaje = "Error al insertar el libro".       
        "<br>".conexion::getConn()->errorInfo()[2];
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Libro</title>
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
    <h1>Insertar libro</h1>
    <nav id='menu'>
        <ul>
        <li><a href="listadoLibros.php">Listado de libros</a></li>
        <li><a href="listadoAutores.php">Listado de autores</a></li> 
        </ul>
        </nav>
    <form action="insertarLibro.php" method="post">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo">
        <br>
        <label for="autor">Autor</label>
        <select id="autor" name="autor" style="display: inline;">
            <?php
            require_once 'autores.php';
            $autores = new autores(conexion::getConn(), 'autores');
            $listado = $autores->listar();
            foreach($listado as $autor){
                echo "<option value='".$autor['idAutor']."'>".$autor['Nombre']." ".$autor['Apellidos']."</option>";
            }
        ?>
        </select><button style="display:inline;"><a  href="insertarAutor.php">Insertar autor</a></button>
        <br>
        <label for="genero">Genero</label>
        <select id="genero" name="genero">
            <option value="Narrativa">Narrativa</option>
            <option value="Lírica">Lírica</option>
            <option value="Teatro">Teatro</option>
            <option value="Científico-Técnico">Científico-Técnico</option>
        </select>
        <br>
        <label for="nPaginas">Número de páginas</label>
        <input type="number" name="nPaginas" id="nPaginas">
        <br>
        <label for="nEjemplares">Número de ejemplares</label>
        <input type="number" name="nEjemplares" id="nEjemplares">
        <br>
        <input type="submit" name="Insertar" value="Insertar">
    
    </form>
    <?php 

    if(isset($mensaje))
      echo "<p class='error'>".$mensaje."</p>";  
    ?>
    <footer>
        <p>Desarrollado por: <a href="">Alberto de la Blanca</a></p>
    </footer>
    
</body>
</html>