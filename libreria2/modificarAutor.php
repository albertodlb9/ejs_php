<?php
    require_once "seguridad.php";
    $seguridad = new Seguridad();
    if(!$seguridad->acceso("bibliotecario")){
        header("Location: index.php");
    }
    if(isset($_POST['Modificar'])){
        require_once 'autores.php';
        require_once 'conexion.php';
        $autores = new autores(conexion::getConn(), 'autores');
        $idAutor = $_GET['id'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $nacionalidad = $_POST['nacionalidad'];
        $autores->actualizar($idAutor, $nombre, $apellidos, $nacionalidad);
        header('Location: listadoAutores.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar autor</title>
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
    <h1>Modificar autor</h1>
    <nav id='menu'>
        <ul>
        <li><a href="listadoLibros.php">Listado de libros</a></li>
        <li><a href="listadoAutores.php">Listado de autores</a></li>
        </ul>
    </nav>
    <?php
        require_once 'autores.php';
        require_once 'conexion.php';
        $autores = new autores(conexion::getConn(), 'autores');
        $idAutor = $_GET['id'];
        $autor = $autores->getAutor($idAutor);
    ?>
    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $autor["Nombre"] ?>">
        <br>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" value="<?php echo $autor["Apellidos"] ?>">
        <br>
        <label for="nacionalidad">Nacionalidad</label>
        <input type="text" name="nacionalidad" id="nacionalidad" value="<?php echo $autor["Pais"] ?>">
        <br>
        <input type="submit" name="Modificar" value="Modificar">
    </form>
</body>
</html>