<?php
require_once 'auxiliar.php';
require_once 'Cliente.php';
session_start();
cabecera();

if(!esta_logueado()){
        return;
    }

if ($_SESSION['nick'] != 'admin'){
    $_SESSION['fallo']= 'No tiene permiso para borrar un cliente';
    return volver_index();
}


// $id = trim($_POST['id']);
$_csrf = obtener_post('_csrf');
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

if (isset($id,$_csrf)) {
    if(!comprobar_csrf($_csrf)){
        return volver_index();
    }
    $cliente = Cliente::buscar_por_id($id);
    // intento invocar el metodo borrar, si no da nulo, si da nul pues se invoca
    $cliente?->borrar_por_id($id);
    $_SESSION['exito']='El cliente  se ha borrado corretamente';
}

header('Location: index.php');