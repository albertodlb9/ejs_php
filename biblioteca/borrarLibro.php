<?php
    require_once "libros.php";
    require_once "conexion.php";

    if(isset($_GET["id"])){
        try{
            $conn = conexion::getConn();
            echo $_GET["id"];
            $id = $_GET["id"];
            $libros = new libros($conn,DB_PREFIX."libros");
            $libros->borrar($id);
            header("Location: listadoLibros.php");
        }
        catch(PDOException $e){
            echo("Error al conectar con la base de datos: ".$e->getMessage());
        }
    }
    
?>