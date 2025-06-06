<?php

namespace Controllers;

use APP\Router;
use Models\Producto;

class ProductoController{
    public static function index(Router $router){
        $productos = Producto::all();
        $router->render('productos/index', [
            'productos' => $productos
        ]);
    }
}