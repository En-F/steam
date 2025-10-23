<?php

function conectar()
{
    return new PDO('pgsql:host=localhost;dbname=steam', 'steam', 'steam');
}

function obtener_post(string $parametro): string|null
{
    return isset($_POST[$parametro]) ? trim($_POST[$parametro]) : null;
}

function obtener_get(string $parametro): string|null
{
    return isset($_GET[$parametro]) ? trim($_GET[$parametro]) : null;
}



function volver_index (){
    header('Location: index.php');
}



function validar_dni($dni ,&$error, ?PDO $pdo = null) 
{
    if ($dni === '') {
            $error[] = 'El DNI es obligatorio';
        } else if ( mb_strlen($dni) > 9) {
                $error[] = 'El DNI es demasiado largo';
        } else {  
            if (buscar_cliente_por_dni($dni,$pdo)){
                $error[] = 'Ya existe un cliente con ese dni';
            }
        } 
}

function validar_nombre($nombre ,&$error) {
    if ($nombre === '') {
            $error[] = 'El nombre es obligatorio';
        } else if ( mb_strlen($nombre) > 255) {
                $error[] = 'El nombre demasiado largo0';
        } else {  
        } 
}


function validar_sanear_apellidos(&$apellidos ,&$error) {
    if ($apellidos === '') {
        $apellidos = null;
    } elseif ( mb_strlen($apellidos) > 255) {
                $error[] = 'Lso apellidos son demasiado largos';
        } else {  
        } 
}


function validar_sanear_direccion(&$direccion ,&$error) {
    if ($direccion === '') {
        $direccion = null;
    } elseif ( mb_strlen($direccion) > 255) {
            $error[] = 'La direccion es  demasiado larga';
        } else {  
        } 
}


function validar_sanear_codpostal(&$codpostal ,$error)
{
    if ($codpostal === '') {
        $codpostal = null;
    } elseif (!ctype_digit($codpostal)){
        $error[] = 'El codigo postal no es válido';
    } elseif (mb_strlen($codpostal) > 5 ){
        $error[] = 'El codigo postal demasiado largo';
    }
}


function validar_sanear_telefono(&$telefono ,$error)
{   
    if ($telefono === ''){
        $telefono = null;
    } elseif (mb_strlen($telefono) > 255 ){
        $error[] = 'El teléfono es demasiado largo';
    }
}


function mostrar_errores(array $error): void
{
    foreach ($error as $mensaje) { ?>
        <h3>Error: <?= htmlspecialchars($mensaje) ?> </h3>
    <?php }
}


function buscar_cliente ($id,$pdo = null ) : array | false
{
    $pdo = $pdo ?? conectar();
    $sent = $pdo->prepare ('SELECT * FROM clientes WHERE id = :id');
    $sent->execute([':id'=> $id]);
    return $sent->fetch();
}

function buscar_cliente_por_dni ($dni, ?PDO $pdo = null ) : array | false
{
    $pdo = $pdo ?? conectar();
    $sent = $pdo->prepare ('SELECT * FROM clientes WHERE dni = :dni');
    $sent->execute([':dni'=> $dni]);
    return $sent->fetch();
}



function validar_dni_update($dni ,$id, &$error, ?PDO $pdo = null) 
{
    if ($dni === '') {
            $error[] = 'El DNI es obligatorio';
        } else if ( mb_strlen($dni) > 9) {
            $error[] = 'El DNI es demasiado largo';
        } else {  
            $pdo = conectar();
            $sent = $pdo->prepare('SELECT * FROM clientes WHERE dni = :dni and id != :id');
            $sent->execute([':dni' => $dni,':id' => $id]);
            if ($sent->fetch()){
                $error[] = 'Ya existe un cliente con ese dni';
            }
        } 
}