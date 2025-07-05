<?php

namespace API;

use Models\Servicio;

class APIServicios {
    public static function procesar() {
        $respuesta = respuestaAPI(mensaje: "Metodo/Operación no implementada");
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $respuesta = respuestaAPI(mensaje: "Método no implementado");
        } else {
            $accion = $_GET['accion'];
            if($accion == 'listar'){
                $respuesta = self::listar();
            } 
        }
        echo json_encode($respuesta);
    }

    private static function listar() {
        $resultado = [];
        $filtro = ['campo' => 'estado', 'operador' => '=', 'valor' => 1];
        $data = Servicio::where([$filtro])->get();
        foreach ($data as $servicio) {
            $servicio->imagen = $_ENV['APP_URL'] . $servicio->imagen; 
        }
        $resultado = respuestaAPI(estado: true, data: $data);
        return $resultado;        
    }
}