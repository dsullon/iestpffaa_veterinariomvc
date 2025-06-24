<?php

namespace Controllers;

use APP\Router;
use Classes\Paginator;
use Models\CategoriaProducto;
use Models\Producto;

class ProductoController{
    public static function index(Router $router){
        $page = (int)($_GET['page'] ?? 1);
        $perPage = (int)($_GET['per_page'] ?? 50);
        $filtros = [
            "campo" => 'estado',
            "operador" => '=',
            "valor" => 1
        ];
        $resultado = Producto::where([$filtros])->page($page)->recordsPerPage($perPage)->paginate();
        $productos = $resultado['data'];
        $meta = $resultado['meta'];
        $filtros = ['campo' => 'activo', 'operador' => "=", 'valor' => 1];
        $categorias = CategoriaProducto::where([$filtros])->get();
        $router->render('productos/index', [
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }
}