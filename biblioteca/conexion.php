<?php
require_once "config.php";

class conexion{
        public static $conn;
       
        public static function getConn(){
            if(!isset(self::$conn)){
                try{
                    self::$conn = new PDO(DB_DRIVER.":host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME,DB_PASSWORD);
                }catch(PDOException $e){
                    echo("Conexion fallida: ".$e->getMessage());
                }
            }
            return self::$conn;
        }

        public function lastError(){
            return self::$conn->errorInfo();
        }
    }
?>    