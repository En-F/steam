<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>
<body>
    <?php
    //crea una instancia de la clase PDO el cual establece una conexción con la base de datos
    $pdo = new PDO('pgsql:host=localhost;dbname=steam;','steam','steam');

    //lo guarmadamos como una sentencia donde el valor es una consulta con el query
    $sent = $pdo->query('SELECT * FROM clientes');
    
    //forma para mostrar las filas siguientes
    //True mientras existan filas
    // foreach( $sent as $fila) {
    //     echo $fila['dni'];
    //     echo $fila['nombre'];
    //     echo $fila['apellidos'];
    //     echo $fila['codpostal'];
    //     echo $fila['telefono'];
    //     echo '<br>';
    // }
    ?>

<table border="1">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Dirección</th>
                <th>Código Postal</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sent as $fila): ?>
                <tr>
                    <td><?= $fila['dni'] ?></td>
                    <td><?= $fila['nombre'] ?></td>
                    <td><?= $fila['apellidos'] ?></td>
                    <td><?= $fila['direccion'] ?></td>
                    <td><?= $fila['codpostal'] ?></td>
                    <td><?= $fila['telefono'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>
</html>