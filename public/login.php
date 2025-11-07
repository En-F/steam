<?php session_start()  //inicar la sesion si no se habia inicado antes o  seguir si ya se ha iniciado
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <?php

    require '../vendor/autoload.php';

    $_csrf = obtener_post('_csrf');
    $nick = obtener_post('nick');
    $password = obtener_post('password');

    if (isset($_csrf, $nick, $password)) {
        if (!comprobar_csrf($_csrf)) {
            return volver_index();
        }
        $pdo = conectar();
        $sent = $pdo->prepare('SELECT * FROM usuarios WHERE nick = :nick');
        $sent->execute([':nick' => $nick]);
        $fila = $sent->fetch();
        if ($fila &&  password_verify($password, $fila['password'])) {
            //recordar que hya un usuario que se ha logeado correctamente y lo voy a recordar
            $_SESSION['nick'] = $nick;
            $_SESSION['exito'] = 'Has iniciado sesión correctamente';
            return volver_index();
        } else {
            echo "<h2>Credenciales incorrectas</h2>";
        }
    }

    ?>
    <div class="container mx-auto mt-10" >
        <form class="max-w-sm mx-auto" action="" method="post">
            <?php campo_csrf() ?>
            <div class="mb-5">
                <label for="nick" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de usuario</label>
                <input type="nick" id="nick" name="nick" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                <input type="password" id="password"  name="password"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Inicar sesión</button>
        </form>
    </div>
</body>

</html>