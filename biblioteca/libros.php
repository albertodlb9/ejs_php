<?php
    require_once("conexion.php");
    class libros{
        protected $conexion;
        protected $tabla;

        public function __construct($conexion,$tabla){
            $this->conexion = $conexion;
            $this->tabla = $tabla;
        }

        public function insertar($titulo, $genero, $autor, $numeroPaginas, $numeroEjemplares){
            $sql = "insert into $this->tabla (Titulo,Genero,idAutor,NumeroPaginas,NumeroEjemplares) values (:titulo, :genero, :autor, :numeroPaginas, :numeroEjemplares);";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(":titulo",$titulo);
            $sentencia->bindParam(":genero",$genero);
            $sentencia->bindParam(":autor",$autor);
            $sentencia->bindParam(":numeroPaginas",$numeroPaginas);
            $sentencia->bindParam(":numeroEjemplares",$numeroEjemplares);
            $sentencia->execute();
            return $this->conexion->lastInsertId();
        }

        public function borrar($id){
            $sql = "delete from $this->tabla where id = :id;";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(":id",$id);
            $sentencia->execute();
        }

        public function actualizar($id,$titulo, $genero, $autor, $numeroPaginas, $numeroEjemplares){
            $sql = "update $this->tabla set Titulo = :titulo, Genero = :genero, idAutor = :autor, NumeroPaginas = :numeroPaginas, NumeroEjemplares = :numeroEjemplares where id = :id;";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(":id",$id);
            $sentencia->bindParam(":titulo",$titulo);
            $sentencia->bindParam(":genero",$genero);
            $sentencia->bindParam(":autor",$autor);
            $sentencia->bindParam(":numeroPaginas",$numeroPaginas);
            $sentencia->bindParam(":numeroEjemplares",$numeroEjemplares);
            $sentencia->execute();
        }

        public function consultarTodo(){
            $sql = "select * from $this->tabla;";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetchAll();
        }

        public function getLibro($id){
            $sql = "select * from $this->tabla where id = :id;";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(":id",$id);
            $sentencia->execute();
            return $sentencia->fetch();
        }
    }
?>