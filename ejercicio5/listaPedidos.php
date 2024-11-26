<?php

function crearTabla($archivo){
    
    if($fp = fopen($archivo,"r")){
        echo "<div>";
        echo "<table>";
        $n = 0; 
       while(!feof($fp)){
        echo"<tr>";
        $linea = fgets($fp);
        $datos = explode(";",$linea);
        foreach($datos as $clave => $valor){
            
            echo"<td>$valor</td>";
            
        }
        if ($n != 0){
            echo"<td>
                   <a href='?$n'>$valor</a>
                </td>";
            echo"</tr>";
        }
        $n++;
       }
       echo"</table>";
       echo "</div>";
       fclose($fp);
    }


}
?>