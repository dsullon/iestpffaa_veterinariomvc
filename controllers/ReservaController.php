<?php

namespace Controllers;

use APP\Router;
use Models\Servicio;

class ReservaController {
    public static function crear(Router $router) {
        $listadoServicios = Servicio::all();
        $router->render('reservas/crear', [
            'servicios' => $listadoServicios
        ]);        
    }    
}