<?php

namespace App\AR;

use App\Utilidades\Cadenas;
use App\Utilidades\Guardable;
use PDO;

abstract class ActiveRecord implements Guardable
{
    use Cadenas;

    public $id;
    private static PDO $pdo;
    protected static string $tabla;

    public function __construct(array $fila = [])
    {
        foreach ($fila as $k => $v) {
            $this->$k = $v;
        }
    }

    public static function buscar_por_id(string|int $id): ?static
    {
        $pdo = static::pdo();
        $tabla = static::$tabla;
        $sent = $pdo->prepare("SELECT * FROM $tabla WHERE id = :id");
        $sent->execute([':id' => $id]);
        return $sent->fetchObject(static::class) ?: null;
    }

    public function borrar(): void
    {
        $pdo = static::pdo();
        $tabla = static::$tabla;
        $sent = $pdo->prepare("DELETE FROM $tabla WHERE id = :id");
        $sent->execute([':id' => $this->id]);
    }

    /**
     * Devuelve todos los objetos.
    *
    * @return static[]
    */
    public static function todos(): array
    {
        $pdo = static::pdo();
        $tabla = static::$tabla;
        $sent = $pdo->query("SELECT * FROM $tabla");
        return $sent->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public abstract function guardar(): void;

    public static function borrar_por_id(string|int $id): void
    {
        static::buscar_por_id($id)?->borrar();
    }

    public static function pdo(): PDO
    {
        static::$pdo = static::$pdo ?? conectar();
        return static::$pdo;
    }
}