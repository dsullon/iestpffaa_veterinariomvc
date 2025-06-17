<?php

namespace API;

use Models\Reserva;

class APIReserva {
    public static function procesar(){
        $respuesta = respuestaAPI(mensaje: "Error en el procesamiento");

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $accion = $_POST['accion'];
            if($accion == "create"){
                $respuesta = self::registrarReserva($_POST);
            } else {
                $respuesta = respuestaAPI(mensaje: "Acción no implementado");
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
                $respuesta = respuestaAPI(estado: true, mensaje: "Registro creado");
            } else {
                $respuesta = respuestaAPI(mensaje: "No se ha podido registrar la reserva");
            }
        }
        return $respuesta;
    }
}