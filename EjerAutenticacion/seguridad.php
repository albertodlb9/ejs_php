<?php
/** Clase para implementar la seguridad de acceso a partes de una AW
 *haremos uso de sesiones php, Credenciales de BD, y Roles de sistema.
 *
 */
require_once './config.php';

 class seguridad{

        protected $conexion;
        protected $rol;
        protected $login;

        public function __construct($conexion){
            $this->conexion = $conexion;
        }

        public function autenticar($login,$password){
            $l = htmlspecialchars($login);
            $p = htmlspecialchars($password);
            $consulta = "select * from usuarios where login = ?;";
            $sentencia = $this->conexion->prepare($consulta);
            $sentencia->setFetchMode(PDO::FETCH_OBJ);
            $sentencia->execute([$l]);
            $fila = $sentencia->fetchObject();
            if($fila && password_verify($p,$fila->password)){
                session_start();
                $_SESSION['login'] = $l;
                $this->login = $l;
                $_SESSION['rol'] = $fila->rol;
                return true;
            }else{
                return false;
            }
        }
        
        public function autorizar($rol=null){
            session_start();
            if($rol == null && $this->estado()){
                return true;
            }
            if(isset($_SESSION['rol'])){
                if($_SESSION['rol'] == $rol){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function cerrarSesion(){
            session_start();
            session_destroy();
            $this->conexion = null;
        }

        public function getLogin(){
            return $this->login;
        }

        public function getRol(){
            return $this->rol;
        }

        public function estado(){
            session_start();
            if(isset($_SESSION['rol'])){
                return true;
            }else{
                return false;
            }
        }

}
  
?>
