<?php

namespace Models;

class Usuario extends ActiveRecord{
    protected static $table = 'usuarios';
    protected static $pk = 'id';
    
    public $id;
    public $uid;
    public $nombres;
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
        $this->nombres = $args['nombres'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->telefono = $args['telefono'] ?? null;
        $this->direccion = $args['direccion'] ?? null;
        $this->password = $args['password'] ?? null;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->estado = $args['estado'] ?? 1;
    }

    public function validar(){
        $errores = [];
        return $errores;
    }

    public function validarLogin() {
        $errores = [];        
        if(!$this->email) {
            $errores['error'][] = 'El Email del usuario es obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errores['error'][] = 'Email no válido';
        }
        if(!$this->password) {
            $errores['error'][] = 'El Password no puede ir vacio';            
        }        
        return $errores;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function comprobarPassword($password) {
        $passwordValido = password_verify($password, $this->password);
        if($passwordValido) {
           return true;
        }
        return false;
    }
}