<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include "persona.php";
        $persona1 = new Persona("Alberto","De la Blanca",27);
        $persona2 = new Persona("Pepe","Perez Garcia",15);

        echo $persona1->mayorEdad();
        echo "<br>";
        echo $persona2->mayorEdad();
        echo "<br>";
        echo $persona1->nombreCompleto();
        echo "<br>";
        echo $persona2->nombreCompleto();
        echo "<br>";
        echo Persona::$nPersonas;
        echo "<br>";
        unset($persona1);
        echo"<br>";
        echo Persona::$nPersonas;
    ?>
</body>
</html>