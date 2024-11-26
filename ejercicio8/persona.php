<?php
    class Persona{
        public static $nPersonas=0;
        private string $nombre;
        private string $apellidos;
        private int $edad;

        public function __construct(string $nombre, string $apellidos, int $edad){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->edad = $edad;
            Persona::$nPersonas++;
        }

        public function __destruct(){
            Persona::$nPersonas--;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getApellidos(){
            return $this->apellidos;
        }

        public function getEdad(){
            return $this->edad;
        }

        public function setNombre(string $nombre){
            $this->nombre = $nombre;
            return $this;
        }

        public function setApellidos(string $apellidos){
            $this->apellidos = $apellidos;
            return $this;
        }

        public function setEdad(int $edad){
            $this->edad = $edad;
            return $this;
        }

        public function mayorEdad(){
            return $this->edad >= 18 ? "es mayor" : "no es mayor";
        }

        public function nombreCompleto(){
            return $this->nombre." " .$this->apellidos;
        }
    }
?>