<?php
if(isset($_GET['id'])){
    require_once 'conexion.php';
    require_once 'libros.php';
    $libros = new libros(conexion::getConn(),'libros');
    $libros->borrar($_GET['id']);
    header('Location: listadoLibros.php');
}
?>