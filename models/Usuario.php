<?php

namespace Models;

class Usuario extends ActiveRecord{
    protected static $table = 'usuarios';
    protected static $pk = 'id';
    
    public $id;
    public $uid;
    public $nombre;
    public $email;
    public $telefono;
    public $direccion;
    public $password;
    public $confirmado;
    public $token;
    public $estado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->uid = $args['uid'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->telefono = $args['telefono'] ?? null;
        $this->direccion = $args['direccion'] ?? null;
        $this->password = $args['password'] ?? null;
        $this->confirmado = $args['password'] ?? null;
        $this->token = $args['password'] ?? null;
        $this->estado = $args['password'] ?? 1;
    }

    public function validar(){
        $errores = [];
        return $errores;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
}