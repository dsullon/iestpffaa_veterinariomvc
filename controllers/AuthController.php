<?php

namespace Controllers;

use APP\Router;
use Models\Usuario;

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
        $token = $_GET['token'] ?? '';        
        $mensaje = "El token enviado no es correcto";
        $estado = false;
        if($token){
            $filtro = ['campo' => 'token', 'operador' => '=', 'valor' => $token];
            $usuario = Usuario::where([$filtro])->get();
            if($usuario){
                $mensaje = "La cuenta se ha activado correctamente";
                $estado = true;
                $usuario = $usuario[0];
                $usuario->token = "";
                $usuario->confirmado = 1;
                $usuario->save();
            }        
        }         
        $router->render('auth/confirmar', [
            'mensaje' => $mensaje,
            'estado' => $estado
        ]);
    }

    public static function olvide(Router $router) {
        $router->render('auth/olvide');
    }
}