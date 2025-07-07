<?php

namespace Controllers;

use APP\Router;
use Classes\SessionHelper;
use Models\Pedido;

class ClienteController{
    public static function index(Router $router) {
        isAuth();
        $router->render('clientes/index');
    }

    public static function pedidos(Router $router) {
        isAuth();
        $usuario = SessionHelper::get('usuario');
        $filtro = ['campo' => 'clienteId', 'operador' => '=', 'valor' => $usuario['id']];
        $pedidos = Pedido::where([$filtro])->orderBy('fecha', 'DESC')->get();
        foreach ($pedidos as $pedido) {
            $pedido->estado = self::generarEstado($pedido->estado);
        }
        $router->render('clientes/pedidos', [
            'pedidos' => $pedidos
        ]);
    }

    private static function generarEstado($codigo){
        $estado='';
        switch ($codigo) {
            case 'LE':
                $estado = 'Listo para envío';
                break;
            case 'ER':
                $estado = 'En ruta';
                break;
            case 'EN':
                $estado = 'Entregado';
                break;
            default:
                $estado = 'Confirmado';
                break;
        }
        return $estado;
    }
}