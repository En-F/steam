<?php
session_start();

//vaciar la variable sesion
$_SESSION = [];

//funcion que destruye una función que se halla con el sesion_start()
session_destroy();