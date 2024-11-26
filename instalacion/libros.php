<?php
class libros{
    protected $conexion;
    protected $tabla;
 public function __construct($conexion, $tabla){
     $this->conexion = $conexion;
     $this->tabla = $tabla;
   
 }   
 public function insertar($titulo, $genero,$autor,$nPaginas,$nEjemplares){
        $sql = "INSERT INTO $this->tabla (Titulo, Genero, idAutor, NumeroPaginas, NumeroEjemplares) VALUES (:titulo, :genero, :autor, :nPaginas, :nEjemplares)";    
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);  
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':nPaginas', $nPaginas);
        $stmt->bindParam(':nEjemplares', $nEjemplares);
        try{
            $stmt->execute();
        }catch(PDOException $e){
            echo "Error al insertar el libro: " . $e->getMessage();
        }
        return $this->conexion->lastInsertId();
    }
    public function borrar($id){
        $sql = "DELETE FROM $this->tabla WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function actualizar($id, $titulo, $genero,$autor,$nPaginas,$nEjemplares){
        $sql = "UPDATE  $this->tabla SET Titulo = :titulo, Genero = :genero, idAutor = :autor, NumeroPaginas = :nPaginas, NumeroEjemplares = :nEjemplares WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':nPaginas', $nPaginas);
        $stmt->bindParam(':nEjemplares', $nEjemplares);
        $stmt->bindParam(':id', $id);
        try{
            $stmt->execute();
        }catch(PDOException $e){
            echo "Error al actualizar el libro: " . $e->getMessage();
        }
    }
    public function listar(){
        $sql = "SELECT * FROM $this->tabla";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getLibro($id){
        $sql = "SELECT * FROM $this->tabla WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
