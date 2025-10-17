<?php

function conectar()
{
    return new PDO('pgsql:host=localhost;dbname=steam', 'steam', 'steam');
}

function obtener_post(string $parametro): string|null
{
    return isset($_POST[$parametro]) ? trim($_POST[$parametro]) : null;
}


function volver_index (){
    header('Location: index.php');
}