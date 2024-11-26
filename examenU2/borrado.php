<?php
    require_once "configDB.php";
    require_once "users.php";

    if(isset($_GET["login"])){
        $conexion = new PDO($DBDriver.":host=".$DBHost.";dbname=".$DBName, $DBUser,$DBPassword);
        $user = new users($conexion);
        $login = $_GET["login"];
        $user->borrar($login);
        header("Location: listado.php");
    }
?>