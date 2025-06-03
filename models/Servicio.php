<?php

namespace Models;

class Servicio extends ActiveRecord {

    protected static $table = "servicios";
    protected static $pk = "id";

    public $id;
    public $nombre;
    public $descripcion;
    public $imagen;
    public $precio;
    public $estado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? 'assets/img/noimage.jpg';
        $this->precio = $args['precio'] ?? 0;
        $this->estado = $args['estado'] ?? 1;
    }

    public function validar() {
        $errores = [];
        if(!$this->nombre){
            $errores[] = "El nombre es obligatorio";
        }
        if(!$this->descripcion){
            $errores[] = "La descripción es obligatoria";
        }
        return $errores;
    }
}