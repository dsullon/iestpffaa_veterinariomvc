<?php

namespace API;

use Classes\Email;
use Classes\SessionHelper;
use Culqi\Culqi;
use Models\DetallePedido;
use Models\Pedido;
use Models\Producto;
use Models\Usuario;

class APICarrito {
    public static function procesar(){
        $respuesta = respuestaAPI(mensaje: "Error en el procesamiento");

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $accion = $_POST['accion'];
            if($accion == "agregar"){
                $respuesta = self::agregarProducto($_POST);
            } elseif($accion == "quitar"){
                $respuesta = self::quitarProducto($_POST);
            
            } elseif($accion == "pagar"){
                $respuesta = self::pagarCompra($_POST);
            } else {
                $respuesta = respuestaAPI(mensaje: "Operación no disponible");
            }
        } else {
            $respuesta = respuestaAPI(mensaje: "Método no implementado");
        }
        echo json_encode($respuesta);
    }

    private static function agregarProducto($data){
        $id = $data['idProducto'];
        $cantidad = $data['cantidad'];
        $producto = Producto::find($id);
        $existe = false;
        $carrito = [];
        if(SessionHelper::has('carrito')){
            $carrito = SessionHelper::get('carrito');
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
                'imagen' => $_ENV['APP_URL'] . $producto->imagen
            ];
            $carrito[] = $productoAgregar;
        }
        SessionHelper::set('carrito', $carrito);
        $respuesta = respuestaAPI(estado: true, mensaje: "Producto agregado");
        return $respuesta;
    }

    private static function quitarProducto($data){
        $id = $data['idProducto'];
        $carrito = SessionHelper::get('carrito', []);
        foreach ($carrito as $key => $item) {
            if($item['id'] == $id){
                unset($carrito[$key]);
                break;
            }
        }
        $carrito = array_values($carrito);
        SessionHelper::set('carrito', $carrito);
        if(count($carrito)==0) SessionHelper::remove('carrito');     
        $respuesta = respuestaAPI(estado: true, mensaje: "Producto removido");
        return $respuesta;
    }

    private static function pagarCompra($data) {
        $respuesta = respuestaAPI(mensaje: "No se ha podido completar el pago");
        /*$culqi = new Culqi(array('api_key' => $_ENV['PAYMENT_KEY_SECRET']));
        $cargo = $culqi->Charges->create(array(
            'email' => $data['email'],
            'token' => $data['token'],
            'amount' => $data['importe'],
            'currency_code' => "PEN",
            'description' => "Venta WEB",
            'source_id' => $data['token']
        ));*/
        $cargo = true;
        if($cargo){
            session_start();
            $clienteID = $_SESSION['usuarioID'];
            $carrito = $_SESSION['carrito'];
            $codigo = uniqid(mt_rand(), true);
            $codigo = strtoupper(substr(md5($codigo), 0, 8));
            $pedido = new Pedido([
                'clienteId' => $clienteID,
                'codigo' => $codigo,
                'total' => $data['importe']
            ]);
            $usuario = Usuario::find($clienteID);
            $errores = $pedido->validar();
            if(empty($errores)){
                Pedido::getDB()->beginTransaction();
                $pedido->save();
                foreach ($carrito as $item) {
                    $detalle = new DetallePedido([
                        'pedidoId' => $pedido->id,
                        'productoId' => $item['id'],
                        'nombreProducto' => $item['nombre'],
                        'cantidad' => $item['cantidad'],
                        'precio' => $item['precio'],
                    ]);
                    $detalle->save();
                }
                //TODO: Insertar en BD
                if(Pedido::getDB()->commit()){
                    unset($_SESSION['carrito']);
                    $email = new Email();
                    $data = [
                        'email' => $usuario->email,
                        'usuario' => $usuario->nombres,
                        'codigo' => $pedido->codigo
                    ];
                    $email->confirmacionCompra($data);
                    $respuesta = respuestaAPI(estado: true, mensaje: "Pedido registrado.", data: $pedido);
                } else {
                    $respuesta = respuestaAPI(mensaje: "No se ha podido registrar el pedido");
                }
            }            
        }
        return $respuesta;
    }
}