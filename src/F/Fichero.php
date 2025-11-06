<?php

namespace App\F;

use App\Utilidades\Cadenas;


class Fichero
{
    use Cadenas;

    public function __construct()
    {
        $l = $this->longitud("hola");
    }
}