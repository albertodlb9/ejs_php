<?php
    require_once "seguridad.php";
    $seguridad = new Seguridad();
    if(!$seguridad->acceso("bibliotecario")){
        header("Location: index.php");
    }
    if(isset($_GET["id"])){
        require_once "conexion.php";
        require_once "autores.php";
        $autores = new autores(conexion::getConn(),"autores");
        $autores->borrar($_GET["id"]);
        header("Location: listadoAutores.php");
    }
?>