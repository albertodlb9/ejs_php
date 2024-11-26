<?php
if(isset($_REQUEST['idLibro'])){
    require_once '../config/config.php';
    require_once 'libros.php';
    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if ($conexion->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error; 
    }
    $libro = new libros($conexion);
    $libro->eliminaLibro($_REQUEST['idLibro']);
    
    $conexion->close();
    header("Location: listar.php");
}
?>
