<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,td{
            border: 1px solid black;
        }
    </style>
    
</head>
<body>
    <?php
    $tablas = array();
    for($i = 0; $i <=10 ; $i++){
        $tablas[$i] = array();
        for($j = 0; $j <=10 ; $j++){
            $tablas[$i][$j] = $i * $j;
        }
    }
    foreach($tablas as $i => $tabla){
        echo "<table>";
        echo "<caption>Tabla del $i</caption>";
        foreach($tabla as $j => $valor){
            echo "<tr>";
            echo "<td>$i x $j = $valor</td>";
            echo "</tr>";
        }
        echo "</table>";
        
    }
    ?>
</body>
</html>
