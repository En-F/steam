<?php

namespace F;

use \Utilidades\Cadenas;

require_once 'Cadenas.php';

class Fichero
{
    use Cadenas;

    public function __construct()
    {
        $l = $this->longitud("hola");
    }
}