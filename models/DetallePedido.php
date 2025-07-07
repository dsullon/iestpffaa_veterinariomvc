<?php

namespace Models;

class DetallePedido extends ActiveRecord{
    protected static $table = "detalle_pedidos";
    protected static $pk = "id";

    public $id;
    public $pedidoId;
    public $productoId;
    public $nombreProducto;
    public $cantidad;
    public $precio;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->pedidoId = $args['pedidoId'] ?? '';
        $this->productoId = $args['productoId'] ?? '';
        $this->nombreProducto = $args['nombreProducto'] ?? '';
        $this->cantidad = $args['cantidad'] ?? 0;
        $this->precio = $args['precio'] ?? 0;
    }

    public function validar() {
        $errores = [];
        if(!$this->pedidoId){
            $errores[] = "No se ha ingresado el id del pedido";
        }
        if(!$this->productoId || !$this->nombreProducto){
            $errores[] = "No se ha ingresado los datos del producto";
        }

        if(!$this->cantidad || $this->cantidad<=0){
            $errores[] = "La cantidad debe ser mayor a cero";
        }

        return $errores;
    }
}