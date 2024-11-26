<?php
    class usuario{
        protected $conexion;
        protected $tabla;
        public function __construct($conexion){
            $this->conexion = $conexion;
        }
        public function login($usuario, $password){
            $sql = "SELECT * FROM usuarios WHERE login = :usuario";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':usuario', $usuario);
            $sentencia->execute();
            $fila = $sentencia->fetch();
            if($fila){
                $salt = $fila['salt'];
                $password = password_verify($password.$salt, $fila['password']);
                if($password){
                    return $fila;
                }
            }else{
                return false;
            }
        }

        public function registrar($nombre, $apellidos, $usuario, $password){
            $sql = "INSERT INTO usuarios(nombre, apellidos, login, password, salt, rol) VALUES(:nombre, :apellidos, :usuario, :password, :salt, :rol)";
            $salt = random_int(10000000,99999999);
            $rol = 'registrado';
            $password = password_hash($password.$salt, PASSWORD_DEFAULT);
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre', $nombre);
            $sentencia->bindParam(':apellidos', $apellidos);
            $sentencia->bindParam(':usuario', $usuario);
            $sentencia->bindParam(':password', $password);
            $sentencia->bindParam(':salt', $salt);
            $sentencia->bindParam(':rol', $rol);
            $sentencia->execute();
        }

        public function listar(){
            $sql = "SELECT * FROM usuarios";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        }

        public function borrar($usuario){
            $sql = "DELETE FROM usuarios WHERE login = :usuario";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':usuario', $usuario);
            $sentencia->execute();
        }

        public function buscar($usuario){
            $sql = "SELECT * FROM usuarios WHERE login = :usuario";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':usuario', $usuario);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            return $resultado;
        }
    }
?>