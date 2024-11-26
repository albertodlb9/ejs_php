<?php
/**
 * Cabecera de mi aplicación
 */
//$raiz = $_SERVER['HTTP_HOST'];
require_once 'config.php';
$raiz=RUTA_APP;
$cabecera="
<header><h1>Biblioteca principal</h1> </header>
    <nav>
        <a href='$raiz/gestion/insertar.php'>Insertar</a>
        <a href='$raiz/gestion/listar.php'>Listar</a>
        <a href='$raiz/gestion/buscar.php'>Buscar</a>
    </nav>";

/**
 * Pie de mi aplicación
 */

$pie=
<<<EX
<footer> <p>Biblioteca version 1.0 </p>
    
</footer>
EX;
?>