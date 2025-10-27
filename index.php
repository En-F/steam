<?php session_start() ?>
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

    if(!esta_logueado()){
        return ;
    }

    $pdo = conectar();
    $sent = $pdo->query('SELECT * FROM clientes');
    ?>
    <?php cabecera()?>
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
                    <td><?= hh($fila['dni']) ?></td>
                    <td><?= hh($fila['nombre']) ?></td>
                    <td><?= hh($fila['apellidos']) ?></td>
                    <td><?= hh($fila['direccion']) ?></td>
                    <td><?= hh($fila['codpostal']) ?></td>
                    <td><?= hh($fila['telefono']) ?></td>
                    <td>
                        <form action="borrar.php" method="post">
                            <?php campo_csrf()?>
                            <input type="hidden" name="id" value="<?= hh($fila['id']) ?>">
                            <button type="submit">Borrar</button>
                        </form>
                    </td>
                    <td>
                        <a href="modificar.php?id=<?= hh($fila['id']) ?>">Modificar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <br>    
    <a href="insertar.php">Insertar nuevo cliente</a>
</body>
</html>