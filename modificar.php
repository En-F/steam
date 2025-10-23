<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar un cliente </title>
</head>
<body>
    <?php 
    require 'auxiliar.php';

    $id = obtener_get('id');

    if(!isset($id)||!ctype_digit($id)){
        return volver_index();
    }

    $pdo = conectar();
    //Buscar la fila
    $fila = buscar_cliente($id, $pdo);

    if(!$fila){
        return volver_index();
    }

    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $dni        = obtener_post('dni');
        $nombre     = obtener_post('nombre');
        $apellidos  = obtener_post('apellidos');
        $direccion  = obtener_post('direccion');
        $codpostal  = obtener_post('codpostal');
        $telefono   = obtener_post('telefono') ; 
        
            if (isset($dni, $nombre, $apellidos, $direccion, $codpostal, $telefono)){
                //Validación
                $error = [];
                validar_dni_update($dni,$id,$error,$pdo);
                validar_nombre($nombre,$error);
                validar_sanear_apellidos($apellidos,$error);
                validar_sanear_direccion($direccion,$error);
                validar_sanear_codpostal($codpostal, $error);
                validar_sanear_telefono($telefono, $error);
                
                if (empty($error)) {
                    $sent = $pdo->prepare('UPDATE  clientes 
                                            set dni = :dni,
                                                nombre = :nombre,
                                                apellidos = :apellidos,
                                                direccion = :direccion,
                                                codpostal = :codpostal,
                                                telefono = :telefono
                                            WHERE id = :id');
                    $sent -> execute([
                        ':id'         => $id,
                        ':dni'        => $dni,
                        ':nombre'     => $nombre ,
                        ':apellidos'  => $apellidos ,
                        ':direccion'  => $direccion ,
                        ':codpostal'  => $codpostal ,
                        ':telefono'   => $telefono,   
                    ]);
                        return  volver_index();    
                    } else {
                        mostrar_errores($error);
                    }
                }
            } else {
                extract($fila);
            }
          
    ?>
    <form action="" method="post">
        <label for="dni">DNI:* </label>
        <input type="text" id="dni" name="dni" value="<?=$dni?>"><br>
        <label for="nombre">Nombre:* </label>
        <input type="text" id="nombre" name="nombre"value="<?=$nombre?>"><br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" id="apellidos"  name="apellidos"value="<?=$apellidos?>"><br>
        <label for="direccion">Dirección: </label>
        <input type="text" id="direccion" name="direccion" value="<?=$direccion?>"><br>
        <label for="codpostal">Código Postal:* </label>
        <input type="text" id="codpostal" name="codpostal" value="<?=$codpostal?>"><br>
        <label for="telefono">Teléfono: </label>
        <input type="text" id="telefono" name="telefono" value="<?=$telefono?>"><br>
        <button type="submit">Modificar</button>
        <a href="index.php">
            <button type="button">Volver para atrás</button>
        </a>
    </form>
</body>
</html>