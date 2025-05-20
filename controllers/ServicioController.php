<?php
namespace Controllers;

use APP\Router;
use Models\Servicio;

class ServicioController {
    public static function index(Router $router){
        $data = Servicio::all();
        foreach ($data as $servicio) {
            $servicio->save();
        }
        $router->render('servicios/index', [
            "servicios" => $data
        ]);
    }

    public static function editar(Router $router){
        $servicio = Servicio::find(1);
        $router->render('servicios/editar');
    }
}
?>