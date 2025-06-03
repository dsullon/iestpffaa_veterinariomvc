<?php
namespace Controllers;

use APP\Router;
use Models\Servicio;

class ServicioController {
    public static function index(Router $router){
        $data = Servicio::all();
        $router->render('servicios/index', [
            "servicios" => $data
        ]);
    }

    public static function editar(Router $router){
        $id = $_GET['id'];
        $servicio = Servicio::find($id);
        $mensaje = "";
        $errores = [];
        if($_SERVER['REQUEST_METHOD'] ==='POST'){
            $servicio->sincronizar($_POST);
            $errores = $servicio->validar();
            if(empty($errores)){
                $servicio->save();
                $mensaje = "Datos guardados";
            }            
        }

        $router->render('servicios/editar', [
            'servicio' => $servicio,
            'mensaje' => $mensaje,
            'errores' => $errores
        ]);
    }

    public static function crear(Router $router) {
        $servicio = new Servicio();
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio = new Servicio($_POST);
            $errores = $servicio->validar();
            if(empty($errores)){
                $servicio->save();
            }
        }
        $router->render('servicios/crear', [
            'servicio' => $servicio,
            'errores' => $errores
        ]);        
    }
}
?>