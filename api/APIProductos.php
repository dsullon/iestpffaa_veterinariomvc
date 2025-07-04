<?php

namespace API;

use Models\Producto;
use Models\Servicio;

class APIProductos {
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
        $data = Producto::where([$filtro])->get();
        foreach ($data as $producto) {
            $producto->imagen = $_ENV['APP_URL'] . $producto->imagen; 
        }
        $resultado = respuestaAPI(estado: true, data: $data);
        return $resultado;        
    }
}