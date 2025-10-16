<?php

function conectar()
{
    return new PDO('pgsql:host=localhost;dbname=steam', 'steam', 'steam');
}