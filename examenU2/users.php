<?php
    class users{
        protected $conexion;

        public function __construct($conexion){
            $this->conexion = $conexion;
        }

        public function insertar($login,$password,$nombre,$apellido1,$apellido2,$avatar){
            $salt = rand(-1000000,1000000);
            $sql = "insert into users (login,password,salt,nombre,apellido1,apellido2,avatar) values (:login,:password,:salt,:nombre,:apellido1,:apellido2,:avatar);";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(":login",$login);
            $sentencia->bindParam(":password",(hash("sha256",$password.$salt)));
            $sentencia->bindParam(":salt",$salt);
            $sentencia->bindParam(":nombre",$nombre);
            $sentencia->bindParam(":apellido1",$apellido1);
            $sentencia->bindParam(":apellido2",$apellido2);
            $sentencia->bindParam(":avatar",$avatar);
            $sentencia->execute();
            return $this->conexion->lastInsertId();
        }

        public function listar(){
            $sql = "select * from users;";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetchAll();
        }

        public function borrar($login){
            $sql = "delete from users where login = :login;";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(":login",$login);
            $sentencia->execute();
        }
    }
?>