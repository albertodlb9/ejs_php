<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file">
        <input type="hidden" name="Alberto de la Blanca Rodriguez">
        <input type="submit" name= "enviar" value="enviar">
    </form>
    <?php
        if(isset($_POST["enviar"])){
            $nombre = $_FILES["file"]["name"];
            $ruta = $_FILES["file"]["tmp_name"];
            $tipo = $_FILES["file"]["type"];
            $tamaño = $_FILES["file"]["size"];

            $destino = "./subidas/".$nombre;
            
            if($tamaño > 200000){
                echo "El archivo supera los 2MB";
            }else if($tipo != "image/jpeg" && $tipo != "image/png" && $tipo != "image/gif" && $tipo != "pdf"){
                echo "El tipo de archivo no es correcto";
            } else{
                if(move_uploaded_file($ruta, $destino)){
                    echo "El archivo se ha subido correctamente";
                    echo "<br>";
                    echo "Tipo de archivo ".$tipo;
                    echo "<br>";
                    echo "Tamaño del archivo ".$tamaño;
                    echo "<br>";
                    echo "Nombre del archivo ".$nombre;
                } else{
                    echo "Ha ocurrido algun error al subir el archivo";
                }
            }
        }
    ?>
</body>
</html>