<?php
class libros {
    private $conexion;
    private function limpiarDatos($datos){
        $datosLimpios = [];
        foreach ($datos as $key => $value) {
            $datosLimpios[$key] = $this->conexion->real_escape_string($value);
        }
        return $datosLimpios;
    }


    public function __construct($conexion=NULL) {
        $this->conexion = $conexion;
    }
    public function insertaLibro($datosLibro) {
        $datosLibro = $this->limpiarDatos($datosLibro);
        $sql = "INSERT INTO libros (idLibro, titulo,genero, idAutor, numeroPaginas,numeroEjemplares) VALUES (NULL ,'$datosLibro[titulo]','$datosLibro[genero]', '$datosLibro[idAutor]', $datosLibro[nPaginas], $datosLibro[nEjemplares]);";
        try{
           return $this->conexion->query($sql);
        }catch(Exception $e){
            echo $e->getMessage();
        }
        
    }
   
    /**
     * Función actualizaLibro
     * Si $datosLibro es un array, actualiza los datos de ese libro
     * Solo actualiza los campos que vienen en el array distintos de NULL
     * el orden en el array es el mismo que en la tabla
     */

    public function actualizaLibro($datosLibro) {
        $miSet = "SET ";
        if($datosLibro['titulo']){
            $miSet .= "titulo = '$datosLibro[titulo]',";
        }
        if($datosLibro['genero']){
            $miSet .= "genero = '$datosLibro[genero]',";
        }
        if($datosLibro['idAutor']){
            $miSet .= "idAutor = $datosLibro[idAutor],";
        }
        if($datosLibro['nPaginas']){
            $miSet .= "numeroPaginas = $datosLibro[nPaginas],";
        }
        if($datosLibro['nEjemplares']){
            $miSet .= "numeroEjemplares = $datosLibro[nEjemplares],";
        }
        $miSet = substr($miSet, 0, -1);
        $sql = "UPDATE libros $miSet WHERE idLibro = $datosLibro[idLibro];";

        return $this->conexion->query($sql);
    }

    public function eliminaLibro($idLibro) {
        $sql = "DELETE FROM libros WHERE idLibro = $idLibro;";
        return $this->conexion->query($sql);
    }
    /**
     * Función consultarLibros
     * Si $idLibro es NULL, devuelve todos los libros
     * Si $idLibro es un número, devuelve los datos de ese libro
     * Pero siempre es un array de arrays
     */

    public function consultarLibros($idLibro=NULL,$titulo=NULL, $genero=NULL, $idAutor=NULL, $nPaginas=NULL, $nEjemplares=NULL){

        $miWhere = "WHERE ";
        if($idLibro){
            $miWhere .= "idLibro = $idLibro";

        }else{
            if($titulo){
                $miWhere .= "titulo LIKE '%$titulo%' AND ";

            }
            if($genero){
                $miWhere .= "genero LIKE '%$genero%' AND ";

            }
            if($idAutor){
                $miWhere .= "idAutor = $idAutor AND ";

            }
            if($nPaginas){
                $miWhere .= "numeroPaginas = $nPaginas AND ";

            }
            if($nEjemplares){
                $miWhere .= "numeroEjemplares = $nEjemplares AND ";

            }
            if($miWhere == "WHERE "){ //Caso en que no hay parámetros devolvemos todos los libros
                $miWhere = "";
            }else{
                 $miWhere = substr($miWhere, 0, -5);
            }    
            
        }
        
        $sql = "SELECT * FROM libros $miWhere;";
        
        $datos=$this->conexion->query($sql); 
        return $datos->fetch_all(MYSQLI_ASSOC);
    }
}
?>
