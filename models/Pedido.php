<?php

namespace Models;

class Pedido extends ActiveRecord{
    protected static $table = "pedidos";
    protected static $pk = "id";

    public $id;
    public $fecha;
    public $codigo;
    public $clienteId;
    public $total;
    public $estado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? date("Y-m-d H:i:s");
        $this->codigo = $args['codigo'] ?? '';
        $this->clienteId = $args['clienteId'] ?? '';
        $this->total = $args['total'] ?? 0;
        $this->estado = $args['estado'] ?? 'CO';
    }

    public function validar() {
        $errores = [];
        if(!$this->codigo){
            $errores[] = "No se ha generado el código del pedido";
        }
        if(!$this->clienteId){
            $errores[] = "No se ha ingresado los datos del cliente";
        }
        return $errores;
    }
}