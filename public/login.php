<?php session_start()  //inicar la sesion si no se habia inicado antes o  seguir si ya se ha iniciado?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php 

        require '../vendor/autoload.php';

        $_csrf = obtener_post('_csrf');
        $nick = obtener_post('nick');
        $password = obtener_post('password');
        
        if (isset($_csrf,$nick,$password)){
            if(!comprobar_csrf($_csrf)){
                return volver_index();
            }
            $pdo = conectar();  
            $sent = $pdo->prepare('SELECT * FROM usuarios WHERE nick = :nick');
            $sent->execute([':nick' => $nick]);
            $fila = $sent->fetch();
            if ($fila &&  password_verify($password, $fila['password'])){
                //recordar que hya un usuario que se ha logeado correctamente y lo voy a recordar
                $_SESSION['nick'] = $nick;
                $_SESSION['exito']='Has iniciado sesión correctamente';
                return volver_index();
            } else{
                echo "<h2>Credenciales incorrectas</h2>";
            }
        }
        
        ?>
        <form action="" method="post">
            <?php campo_csrf()?>
            <label for="nick">Nombre de Usuario:</label>
            <input type="text" id="nick" name="nick"><br>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password"><br>

            <button type="submit">Inicar sesión</button>
        </form>
</body>
</html>

