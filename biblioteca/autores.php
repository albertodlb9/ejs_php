<?php
    class autores{
        protected $conexion;
        protected $tabla;

        public function __construct($conexion,$tabla){
            $this->conexion = $conexion;
            $this->tabla = $tabla;
        }

        public function insertar($nombre,$apellidos,$pais){
            $sql = "insert into $this->tabla (Nombre,Apellidos,Pais) values (:nombre, :apellidos, :pais);";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(":nombre",$nombre);
            $sentencia->bindParam(":apellidos",$apellidos);
            $sentencia->bindParam(":pais",$pais);
            $sentencia->execute();
            return $this->conexion->lastInsertId();
        }

        public function borrar($id){
            $sql = "delete from $this->tabla where id = :id;";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(":id",$id);
            $sentencia->execute();
        }

        public function actualizar($id,$nombre,$apellidos,$pais){
            $sql = "update $this->tabla set Nombre = :nombre, Apellidos = :apellidos, Pais = :pais where id = :id;";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(":id",$id);
            $sentencia->bindParam(":nombre",$nombre);
            $sentencia->bindParam(":apellidos",$apellidos);
            $sentencia->bindParam(":pais",$pais);
            $sentencia->execute();
        }

        public function consultarTodo(){
            $sql = "select * from $this->tabla;";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetchAll();
        }
    }
?>