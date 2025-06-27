<?php

namespace Controllers;

use APP\Router;

class AuthController{

    public static function index(Router $router) {
        $router->render('auth/index');
    }

    public static function login(Router $router) {
        depurar(uniqid());
        $router->render('auth/login');
    }
}