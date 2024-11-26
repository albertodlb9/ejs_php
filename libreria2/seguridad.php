<?php
    class Seguridad{

        public function __construct(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }


        public function acceso(...$rol){
            if(!isset($_SESSION['rol'])){
                return false;
            }else{
                if(!in_array($_SESSION['rol'], $rol)){
                    return false;
                }else{
                    return true;
                }
            }
        }
    }
?>