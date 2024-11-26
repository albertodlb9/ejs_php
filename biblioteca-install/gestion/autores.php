<?php
class autores{
    private $conexion;
    public function __construct($conexion=NULL) {   
        $this->conexion = $conexion;
    }
    private function limpiarDatos($datos){
        $datosLimpios = [];
        foreach ($datos as $key => $value) {
            $datosLimpios[$key] = $this->conexion->real_escape_string($value);
        }
        return $datosLimpios;
    }
    public function insertaAutor($datosAutor) {
        $datosAutor = $this->limpiarDatos($datosAutor);
        $sql = "INSERT INTO autores (idAutor, Nombre, Apellidos,Pais) VALUES (NULL,'$datosAutor[Nombre]','$datosAutor[Apellidos]','$datosAutor[Pais]');";
        return $this->conexion->query($sql);
    }
    /**
     * Función actualizaAutor
     * Si $datosAutor es un array, actualiza los datos de ese autor
     * Solo actualiza los campos que vienen en el array distintos de NULL
     * el orden en el array es el mismo que en la tabla
     */
    public function actualizaAutor($datosAutor) {
        $miSet = "SET ";
        if($datosAutor['nombre']){
            $miSet .= "nombre = '$datosAutor[nombre]',";
        }
        if($datosAutor['apellidos']){
            $miSet .= "apellidos = '$datosAutor[apellidos]',";
        }
        if($datosAutor['pais']){
            $miSet .= "pais = '$datosAutor[pais]',";
        }
        $miSet = substr($miSet, 0, -1);
        $sql = "UPDATE autores $miSet WHERE idAutor = $datosAutor[idAutor];";
        return $this->conexion->query($sql);
    }
    public function eliminaAutor($idAutor) {
        $sql = "DELETE FROM autores WHERE idAutor = $idAutor;";
        return $this->conexion->query($sql);
    }
    /**
     * Función consultarAutores
     * Si $idAutor es NULL, devuelve todos los autores
     * Si $idAutor es un número, devuelve los datos de ese autor
     * Pero siempre es un array de arrays
     */
    public function consultaAutores($idAutor=NULL,$nombre=NULL,$apellidos=NULL,$pais=NULL){
        if($idAutor){
            $sql="SELECT * FROM autores WHERE idAutor = $idAutor;";
            $datos=$this->conexion->query($sql);
            return $datos->fetch_all(MYSQLI_ASSOC);
        }else{
            $miWhere = "WHERE ";
            if($nombre){
                $miWhere .= "nombre = '$nombre' AND ";
            }
            if($apellidos){
                $miWhere .= "apellidos = '$apellidos' AND ";
            }
            if($pais){
                $miWhere .= "pais = '$pais' AND ";
            }
            if($miWhere == "WHERE "){ 
                $miWhere = "";
            }else{
            $miWhere = substr($miWhere, 0, -5);
            }
            $sql = "SELECT * FROM autores $miWhere order by Apellidos;";
            $datos = $this->conexion->query($sql);
            return $datos->fetch_all(MYSQLI_ASSOC);
        }
    }
}
?>