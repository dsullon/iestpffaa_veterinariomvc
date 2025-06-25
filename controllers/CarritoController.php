<?php 
namespace Controllers;

use APP\Router;

class CarritoController{

    public static function index(Router $router){
        session_start();
        $carrito = $_SESSION['carrito'] ?? [];
        $router->render('carrito/index', [
            'carrito' => $carrito
        ]);
    }
}