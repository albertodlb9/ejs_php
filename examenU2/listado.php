<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
    <style>
        table,td,th{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h1>Lista de usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>Login</th>
                <th>Nombre</th>
                <th>Apellido 1</th>
                <th>Apellido 2</th>
                <th>Avatar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once "configDB.php";
                require_once "users.php";
                $conexion = new PDO($DBDriver.":host=".$DBHost.";dbname=".$DBName, $DBUser,$DBPassword);
                $user = new users($conexion);
                $users = $user->listar();
                foreach($users as $usuario){
                    echo "<tr>";
                    echo "<td>".$usuario["login"]."</td>";
                    echo "<td>".$usuario["nombre"]."</td>";
                    echo "<td>".$usuario["apellido1"]."</td>";
                    echo "<td>".$usuario["apellido2"]."</td>";
                    echo "<td><img src ='".$usuario["avatar"]."' width = '50' heigth = '50'></td>";
                    echo "<td><a href = 'borrado.php?login=".$usuario["login"]."'>Borrar</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <a href="insertado.php">Insertar usuario</a>
</body>
</html>