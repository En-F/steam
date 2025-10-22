<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>
<body>
    <?php
    require 'auxiliar.php';

    $pdo = conectar();
    $sent = $pdo->query('SELECT * FROM clientes');
    ?>
    <table border="1">
        <thead>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Código postal</th>
            <th>Teléfono</th>
            <th colspan="2">Acciones</th>
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
                    <td>
                        <form action="borrar.php" method="post">
                            <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                            <button type="submit">Borrar</button>
                        </form>
                    </td>
                    <td>
                        <a href="modificar.php?id=<?= $fila['id'] ?>">Modificar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <br>    
    <a href="insertar.php">Insertar nuevo cliente</a>
</body>
</html>