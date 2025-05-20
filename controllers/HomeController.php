<?php
namespace Controllers;

use APP\Router;

class HomeController{
    public static function index(Router $router){
        $router->render('home/index');
    }

    public static function notfound(Router $router){
        $router->render('home/404');
    }
}