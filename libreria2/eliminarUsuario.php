<?php
    require_once 'seguridad.php';
    $seguridad = new Seguridad();
    if(!$seguridad->acceso('administrador')){
        header('Location: index.php');
    }
    if(isset($_GET['login'])){
        require_once 'conexion.php';
        require_once 'usuarios.php';
        $usuarios = new usuario(conexion::getConn(), 'usuarios');
        $usuario = $usuarios->buscar($_GET['login']);
        if($usuario['rol'] != 'administrador'){
            $usuarios->borrar($_GET['login']);
            header('Location: gestionUsuarios.php');
        }else{
            header('Location: gestionUsuarios.php');
        }
    }else{
        header('Location: gestionUsuarios.php');
    }
?>