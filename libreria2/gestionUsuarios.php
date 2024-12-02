<?php
    require_once "seguridad.php";
    $seguridad = new Seguridad();
    if(!$seguridad->acceso("administrador")){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Gestion de usuarios</title>
</head>
<body>
    <?php       
        $usuario = $_SESSION['usuario'];
        echo "<p><strong>$usuario</strong>  <a href='cerrarSesion.php'>Cerrar sesion</a></p>";       
    ?>
    <h1>Gestion de usuarios</h1>
    <nav id='menu'>
        <a href="index.php">Volver al inicio</a>
    </nav>
    <h2>Lista de usuarios</h2>
    <div class="tabla">
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Usuario</th>
            <th>Rol</th>
        </tr>
        <?php
            require_once 'usuarios.php';
            require_once 'conexion.php';
            $usuarios = new usuario(conexion::getConn(), 'usuarios');
            $listado = $usuarios->listar();
            foreach($listado as $usuario){
                echo "<tr>";
                echo "<td>".$usuario['nombre']."</td>";
                echo "<td>".$usuario['apellidos']."</td>";
                echo "<td>".$usuario['login']."</td>";
                echo "<td>".$usuario['rol']."</td>";
                echo "<td class='modificar'><button><a href='modificarUsuario.php?login=".$usuario['login']."'>Modificar</a></button></td>";
                if($usuario['rol'] != 'administrador'){
                    echo "<td class='eliminar'><button><a href='eliminarUsuario.php?login=".$usuario['login']."'>Eliminar</a></button></td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
    </div>
</body>
</html>