<?php
namespace Controllers;

use APP\Router;

class HomeController{
    public static function index(Router $router){
        $router->render('home/index');
    }

    public static function nosotros(Router $router){
        $router->render('home/nosotros');
    }

    public static function notfound(Router $router){
        $router->render('home/404');
    }
}