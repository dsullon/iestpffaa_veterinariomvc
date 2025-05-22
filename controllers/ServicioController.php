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
        if($_SERVER['REQUEST_METHOD'] ==='POST'){            
            $servicio->sincronizar($_POST);
            $servicio->save();
            $mensaje = "Datos guardados";
        }

        $router->render('servicios/editar', [
            'servicio' => $servicio,
            'mensaje' => $mensaje
        ]);
    }
}
?>