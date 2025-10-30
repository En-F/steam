<?php

require_once 'auxiliar.php';

class Cliente
{
    //Acesible desde fuera de la clase
    //Toda instancia de la clase cliente tendra esas propiedades(se le llaman propiedades a los atributos que son campos)
    public $id;
    public $dni;
    public $nombre;
    public $apellidos;
    public $direccion;
    public $codpostal;
    public $telefono;
    
    private static $pdo;

    public function __construct(array $fila = [])
    {
        foreach($fila as $k => $v){
            $this->$k=$v;
        }
    }

    public function guardar():void
    {   $pdo = Cliente::pdo();
        $sent = $pdo->prepare('INSERT INTO clientes (dni, nombre, apellidos, direccion, codpostal, telefono)
                                   VALUES (:dni, :nombre, :apellidos, :direccion, :codpostal, :telefono)');
            $sent -> execute([
                'dni'        => $this->dni,
                'nombre'     => $this->nombre ,
                'apellidos'  => $this->apellidos ,
                'direccion'  => $this->direccion ,
                'codpostal'  => $this->codpostal ,
                'telefono'   => $this->telefono, 
            ]);
    }

    
    public static function buscar_por_id(string $id): ?Cliente
    {
        $pdo = Cliente::pdo();
        $sent = $pdo->prepare ('SELECT * FROM clientes WHERE id = :id');
        $sent->execute([':id'=> $id]);
        //si da tru devuelve a(izquierda) si no devuelve el de la derecha
        return $sent->fetchObject(Cliente::class) ?: null;    
    }
    
    /**
     * Devuelve todos los clientes 
     * 
     * @return Cliente[]
    */
    public static function todos(): array
    {
        $pdo= Cliente::pdo();
        $sent = $pdo->query('SELECT *  FROM clientes');
        return $sent-> fetchAll(PDO::FETCH_CLASS,Cliente::class);
    }
    
    public static function borrar_por_id(string|int $id):void
    {
        Cliente:: buscar_por_id($id)?->borrar();
    }


    public function borrar(): void
    {
        $pdo= Cliente::pdo();
        $sent = $pdo->prepare("DELETE FROM clientes WHERE id = :id");
        //referencia a la instacia que recibe el mensaje
        $sent->execute([':id' => $this->id]);
    }
    
    
    
    public static function pdo(): PDO
    {
        Cliente::$pdo = Cliente::$pdo ?? conectar();
        return Cliente::$pdo;
    }

    

}