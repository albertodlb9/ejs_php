<?php
    session_start();
    if(isset($_SESSION['rol'])){
        session_unset();
    }
    session_destroy();
    header('Location: index.php');
?>