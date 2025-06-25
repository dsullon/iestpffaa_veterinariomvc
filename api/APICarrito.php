<?php

namespace API;

use Models\Producto;

class APICarrito {
    public static function procesar(){
        $respuesta = respuestaAPI(mensaje: "Error en el procesamiento");

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $accion = $_POST['accion'];
            if($accion == "agregar"){
                $respuesta = self::agregarProducto($_POST);
            } elseif($accion == "quitar"){
                $respuesta = self::quitarProducto($_POST);
            } else {
                $respuesta = respuestaAPI(mensaje: "Operación no disponible");
            }
        } else {
            $respuesta = respuestaAPI(mensaje: "Método no implementado");
        }
        echo json_encode($respuesta);
    }

    private static function agregarProducto($data){
        session_start();
        $id = $data['idProducto'];
        $cantidad = $data['cantidad'];
        $producto = Producto::find($id);
        $existe = false;
        $carrito = [];
        if(isset($_SESSION['carrito'])){
            $carrito = $_SESSION['carrito'];
        }
        foreach ($carrito as &$item) {
            if($item['id']==$id){
                $item['cantidad'] += $cantidad;
                $existe = true;
                break;
            }
        }
        unset($item);
        if(!$existe){
            $productoAgregar = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $cantidad,
                'imagen' => BASE_URL . $producto->imagen
            ];
            $carrito[] = $productoAgregar;
        }
        $_SESSION['carrito'] = $carrito;
        $respuesta = respuestaAPI(estado: true, mensaje: "Producto agregado");
        return $respuesta;
    }

    private static function quitarProducto($data){
        session_start();
        $id = $data['idProducto'];
        $carrito = $_SESSION['carrito'];
        if(isset($carrito)){
            foreach ($carrito as $key => $item) {
                if($item['id'] == $id){
                    unset($carrito[$key]);
                    break;
                }
            }
            $carrito = array_values($carrito);
            $_SESSION['carrito'] = $carrito;
            if(count($carrito)==0) unset($_SESSION['carrito']);
        }        
        $respuesta = respuestaAPI(estado: true, mensaje: "Producto removido");
        return $respuesta;
    }
}