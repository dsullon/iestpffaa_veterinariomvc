<?php

namespace Controllers;

use APP\Router;

class AuthController{

    public static function index(Router $router) {
        $router->render('auth/index');
    }

    public static function login(Router $router) {
        $router->render('auth/login');
    }

    public static function registrar(Router $router){
        $router->render('auth/registrar');
    }

    public static function confirmar(Router $router) {
        $router->render('auth/confirmar');
    }

    public static function olvide(Router $router) {
        $router->render('auth/olvide');
    }
}