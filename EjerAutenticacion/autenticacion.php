<?php


// Si ha pulsado el boton entrar

// Aquí recibe los datos y comrpueba si existe en la tabla de usuarios 

// Si existe crea la sesion sin nombre y crea la variable de sesión para recoger el valor del rol

//Si no existe informa a la página mediante url-sucia
require_once './config.php';
require_once './seguridad.php';
session_start();

$conexion = new PDO("mysql:host=$DB_host;dbname=$DB_name",$DB_user,$DB_password);
$seguridad = new seguridad($conexion);

if(isset($_POST['entrar'])){
  $l = htmlspecialchars($_POST['login']);
  $p = htmlspecialchars($_POST['password']);
  
    if($seguridad->autenticar($l,$p)){
        $mensaje = "Autenticado";
        if($seguridad->autorizar("admin")){
            header("Location: seguraAdmin.php");
        }else{
            header("Location: segura.php");
        }
    }else{
        $mensaje = "No autenticado";
        header("Location: autenticacion.php?mensaje=$mensaje");
    }
    
}  

?>



<html>
<body>
<p>1.- Cree una base de datos y una tabla llamada usuarios con los campos: login(varchar 20) PK
, password( varchar (512)) rol( Enum("admin","usuario"). 	</p>
<p>2.- Rellene los datos de config.php con las credenciales de acceso a su base de datos</p>
<p>2.- Rellene los datos de config.php con las credenciales de acceso a su base de datos</p>
<p>3.- Abra este archivo y cree la comprobación de autenticación </p>	

<?php
if($seguridad->estado()){
    echo("<a href='salir.php'>Cerrar sesion</a>");
}else{
?>
<form method="POST" id="formularioAutenticacion" >

usuario <input type="text" name="login" />
contraseña <input type="password" name="password"/>
<input type="submit" name="entrar" value="entrar"/>	


</form>
<?php
}
if(isset($_GET['mensaje'])){
    echo("<p class ='mal'>".$_GET['mensaje']."</p>");
}
if(isset($mensaje)){
    echo("<p class = 'bien'>".$mensaje."</p>");
}
?>

</body>

</html>
