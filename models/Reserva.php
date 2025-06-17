<?php

namespace Models;

class Reserva extends ActiveRecord {
    protected static $table = "reservas";
    protected static $pk = "id";
    
    public $id;
    public $cliente;
    public $email;
    public $fecha;
    public $hora;
    public $servicioId;
    public $estado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->servicioId = $args['servicioId'] ?? '';
        $this->estado = $args['estado'] ?? 'R';
    }

    public function validar(): array{
        $errores = [];
        if(!$this->cliente){
            $errores[] = "El nombre del cliente es obligatorio";
        }
        if(!$this->email){
            $errores[] = "El email es obligatorio";
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errores[] = "El email debe ser un un email válido";
        }
        if(!$this->fecha){
            $errores[] = "La fecha de reserva es obligatoria";
        }
        if(!$this->hora){
            $errores[] = "La hora de reserva es obligatoria";
        }
        if(!$this->servicioId){
            $errores[] = "El servicio es obligatorio";
        }
        return $errores;
    }
}