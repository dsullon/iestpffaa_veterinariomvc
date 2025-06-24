<?php

namespace Models;

class CategoriaProducto extends ActiveRecord{
    protected static $table = "categoriaproductos";
    protected static $pk = "id";

    public $id;
    public $nombre;
    public $activo;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->activo = $args['activo'] ?? 1;
    }
}