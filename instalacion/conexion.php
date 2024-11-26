<?php
require_once 'config.php';
class conexion{
    protected static $conn;
    public function __construct(){
        self::getConn();
    }
       
    public static function getConn(){
        if(!isset(self::$conn)){
            try{
                self::$conn = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
            }catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$conn;
    }
    public function __destruct(){
        self::$conn = null;
    }
    public static function lastError(){
        return self::$conn->errorInfo();
    }
}
?>