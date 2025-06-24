<?php
namespace Models;

class Producto extends ActiveRecord{
    protected static $table = "productos";
    protected static $pk = "id";

    public $id;
    public $nombre;
    public $descripcion;
    public $imagen;
    public $precio;
    public $categoriaId;
    public $estado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? 'assets/img/noimage.jpg';
        $this->precio = $args['precio'] ?? 0;
        $this->categoriaId = $args['categoriaId'] ?? '';
        $this->estado = $args['estado'] ?? 1;
    }
}