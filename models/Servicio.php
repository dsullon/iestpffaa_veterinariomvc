<?php

namespace Models;

class Servicio extends ActiveRecord {

    protected static $table = "servicios";
    protected static $pk = "id";

    public $nombre;
    public $descripcion;
    public $imagen;
    public $precio;
    public $estado;

    public function test() {
        print_r(self::$db);
    }
}