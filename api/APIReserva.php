<?php

namespace API;

use Classes\Email;
use Models\Reserva;
use Models\Servicio;

class APIReserva {
    
    public static function procesar(){
        $respuesta = respuestaAPI(mensaje: "Error en el procesamiento");

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $accion = $_POST['accion'];
            if($accion == "create"){
                $respuesta = self::registrarReserva($_POST);
            } else {
                $respuesta = respuestaAPI(mensaje: "Operación no implementada");
            }
        } else {
            $respuesta = respuestaAPI(mensaje: "Método no implementado");
        }
        echo json_encode($respuesta);
    }

    private static function registrarReserva($datos){
        $respuesta = respuestaAPI(mensaje: "No se ha podido completar la operación");
        $reserva = new Reserva($datos);
        $errores = $reserva->validar();
        if(!empty($errores)){
            $respuesta = respuestaAPI(mensaje: "Los datos se encuentran incompletos");
        } else {
            $exito = $reserva->save();
            if($exito){
                $reserva->servicio = Servicio::find($reserva->servicioId);
                $data = [
                    'cliente' => $reserva->cliente,
                    'email' => $reserva->email,
                    'fecha' => $reserva->fecha,
                    'hora' => $reserva->hora,
                    'servicio' => $reserva->servicio->nombre
                ];
                $mail = new Email();
                $status = $mail->confirmacionReserva($data);
                if($status){
                    $respuesta = respuestaAPI(estado: true, mensaje: "Registro creado");
                } else {
                    $respuesta = respuestaAPI(estado: true, mensaje: "Registro creado pero hubo un error en el envío de email");
                }
            } else {
                $respuesta = respuestaAPI(mensaje: "No se ha podido registrar la reserva");
            }
        }
        return $respuesta;
    }
}