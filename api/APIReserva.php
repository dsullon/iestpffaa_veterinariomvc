<?php

namespace API;

class APIReserva {
    public static function procesar(){
        $respuesta = [
            'estado' => true,
            'mensaje' => 'Datos procesados'
        ];

        echo json_encode($respuesta);
    }
}