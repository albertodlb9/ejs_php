<?php
class autores{
    protected $conexion;
    protected $tabla;
 public function __construct($conexion, $tabla){
     $this->conexion = $conexion;
     $this->tabla = $tabla;
   
 }   
 public function insertar($nombre, $apellidos, $nacionalidad){
     $sql = "INSERT INTO $this->tabla (Nombre, Apellidos, Pais) VALUES (:nombre, :apellidos, :nacionalidad)";
     $stmt = $this->conexion->prepare($sql);
     $stmt->bindParam(':nombre', $nombre);
     $stmt->bindParam(':apellidos', $apellidos);
     $stmt->bindParam(':nacionalidad', $nacionalidad);
     try{
         $stmt->execute();  
        }catch(PDOException $e){
            echo "Error al insertar el autor: " . $e->getMessage();
        }

     return $this->conexion->lastInsertId();
 }
 public function borrar($id){
     $sql = "DELETE FROM $this->tabla WHERE id = :id";
     $stmt = $this->conexion->prepare($sql);
     $stmt->bindParam(':id', $id);
     $stmt->execute();
 }
    public function actualizar($id, $nombre, $apellidos, $nacionalidad){
        $sql = "UPDATE $this->tabla SET Nombre = :nombre, Apellidos = :apellidos, Pais = :nacionalidad WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':nacionalidad', $nacionalidad);
        $stmt->bindParam(':id', $id);
        try{
            $stmt->execute();   
        }catch(PDOException $e){
            echo "Error al actualizar el autor: " . $e->getMessage();
        }
       
    }
    public function listar(){
        $sql = "SELECT * FROM $this->tabla";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getAutor($id){
        $sql = "SELECT * FROM $this->tabla WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>