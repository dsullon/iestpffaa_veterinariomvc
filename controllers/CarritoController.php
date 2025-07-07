<?php 
namespace Controllers;

use APP\Router;
use Models\Pedido;
use Models\Usuario;

class CarritoController{

    public static function index(Router $router){
        session_start();
        $carrito = $_SESSION['carrito'] ?? [];
        $router->render('carrito/index', [
            'carrito' => $carrito
        ]);
    }

    public static function compra(Router $router){
        session_start();
        isAuth();
        $total = 0;
        $usuario = Usuario::find($_SESSION['usuarioID']);
        $carrito = $_SESSION['carrito'] ?? [];
        foreach ($carrito as $item) {
            $total += number_format($item['precio'] * $item['cantidad'], 2);
        }
        $router->render('carrito/compra', [
            'usuario' => $usuario,
            'items' => $carrito,
            'total' => $total
        ]);
    }

    public static function confirmacion(Router $router) {
        session_start();
        isAuth();
        $codigo = $_GET['codigo'] ?? '';
        $filtros = ['campo' => 'codigo', 'operador' => '=', 'valor' => $codigo];
        $pedido = Pedido::where([$filtros])->get();
        if($pedido){
            $router->render('carrito/confirmacion');
        } else {
            header('location: /');
        }
    }
}