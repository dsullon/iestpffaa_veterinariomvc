<?php
namespace Controllers;

use APP\Router;

class ServicioController {
    public static function index(Router $router){
        $router->render('servicios/index');
    }
}
?>