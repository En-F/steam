<?php namespace App; ?>
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
    require '../vendor/autoload.php';
    require_once '../src/auxiliar.php';

    use App\AR\Cliente;

    if (!esta_logueado()) {
        return;
    }
    ?>
    <?php cabecera() ?>
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
            <?php foreach (Cliente::todos() as $cliente): ?>
                <tr>
                    <td><?= hh($cliente->dni) ?></td>
                    <td><?= hh($cliente->nombre) ?></td>
                    <td><?= hh($cliente->apellidos) ?></td>
                    <td><?= hh($cliente->direccion) ?></td>
                    <td><?= hh($cliente->codpostal) ?></td>
                    <td><?= hh($cliente->telefono) ?></td>
                    <td>
                        <form action="borrar.php" method="post">
                            <?php campo_csrf() ?>
                            <input type="hidden" name="id" value="<?= hh($cliente->id) ?>">
                            <button type="submit">Borrar</button>
                        </form>
                    </td>
                    <td>
                        <a href="modificar.php?id=<?= hh($cliente->id) ?>">Modificar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <a href="insertar.php">Insertar un nuevo cliente</a>
</body>
</html>