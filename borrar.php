<?php
require 'auxiliar.php';
session_start();
cabecera();

if(!esta_logueado()){
        return;
    }

if ($_SESSION['nick'] != 'admin'){
    return volver_index();
}


// $id = trim($_POST['id']);
$_csrf = obtener_post('_csrf');
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

if (isset($id,$_csrf)) {
    if(!comprobar_csrf($_csrf)){
        return volver_index();
    }
    $pdo = conectar();
    $sent = $pdo->prepare("DELETE FROM clientes WHERE id = :id");
    $sent->execute([':id' => $id]);
}

header('Location: index.php');