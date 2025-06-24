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
        $cat = $_GET['cat'] ?? 0;
        $min = $_GET['min'] ?? 0;
        $max = $_GET['max'] ?? 0;
        $filtros = [];
        $filtros[] = ["campo" => 'estado', "operador" => '=', "valor" => 1];
        if($cat > 0){
            $filtros[] = ['campo' => 'categoriaId', 'operador' => "=",'valor' => $cat];
        }
        if($min > 0 && $max > 0 && $min <= $max){
            $filtros[] = ['campo' => 'precio', 'operador' => '>=', 'valor' => $min];
            $filtros[] = ['campo' => 'precio', 'operador' => '<=', 'valor' => $max];
        }
        $resultado = Producto::where($filtros)->page($page)->recordsPerPage($perPage)->paginate();
        $productos = $resultado['data'];
        $meta = $resultado['meta'];
        $filtros = ['campo' => 'activo', 'operador' => "=", 'valor' => 1];
        $categorias = CategoriaProducto::where([$filtros])->get();
        $router->render('productos/index', [
            'productos' => $productos,
            'categorias' => $categorias,
            'filtroCat' => $cat,
            'filtroMin' => $_GET['min'] ?? '',
            'filtroMax' => $_GET['max'] ?? ''
        ]);
    }
}