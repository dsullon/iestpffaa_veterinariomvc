<?php

namespace Controllers;

use APP\Router;

class ReservaController {
    public static function crear(Router $router) {
        $router->render('reservas/crear');        
    }    
}