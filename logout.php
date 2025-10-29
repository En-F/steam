<?php
//CIERRE DE LA SESIOn
session_start();

//vaciar la variable sesion
$_SESSION = [];
$params = session_get_cookie_params(); //te devuelve un array con todos los parametros de la sesion
//sesion_name te devuelve el nombre que se utilza en la sesión
setcookie(session_name(),
                        '',
                        1,
                        $params['path'],
                        $params['domain'],
                        $params['secure'],
                        $params['httponly']
);
//funcion que destruye una función que se halla con el sesion_start()
session_destroy();
$_SESSION['exito']='Sesión finalizada correctamente';
header(('Location: login.php'));