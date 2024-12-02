<?php
    require_once "seguridad.php";
    $seguridad = new Seguridad();
    if(!$seguridad->acceso("bibliotecario")){
        header("Location: index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Listado de autores</title>
</head>
<body>
<?php
        if(isset($_SESSION['rol'])){
            $usuario = $_SESSION['usuario'];
            echo "<p><strong>$usuario</strong>  <a href='cerrarSesion.php'>Cerrar sesion</a></p>";
            echo "<h1>Listado de autores</h1>";
    ?>
    <nav id='menu'>    
    <?php
        if($_SESSION['rol'] == 'administrador' || $_SESSION['rol'] == 'bibliotecario'){
    ?>
    <a href="listadoLibros.php">Listado de libros</a>
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
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Nacionalidad</th>
        </tr>
        <?php
            require_once "autores.php";
            require_once "conexion.php";
            $autores = new autores(conexion::getConn(),"autores");
            $listaAutores = $autores->listar();
            foreach($listaAutores as $autor){
                echo "<tr>";
                echo "<td>".$autor["Nombre"]."</td>";
                echo "<td>".$autor["Apellidos"]."</td>";
                echo "<td>".$autor["Pais"]."</td>";
                echo "<td><a href='borrarAutor.php?id=".$autor["idAutor"]."'>Eliminar</a></td>";
                echo "<td><a href='modificarAutor.php?id=".$autor["idAutor"]."'>Modificar</a></td>";
                echo "</tr>";
            }

        ?>
    </table>
</body>
</html>