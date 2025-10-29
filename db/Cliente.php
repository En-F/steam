<?php
require 'auxiliar.php';

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
    
}