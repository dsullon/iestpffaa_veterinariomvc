<?php

namespace APP;

class Router {
    public array $getRoutes = [];
    public array $postRoutes = [];


    public function get($url, $func) {
        $this->getRoutes[$url] = $func;
    }

    public function post($url, $func) {
        $this->postRoutes[$url] = $func;
    }

    public function validarRutas() {
        $rutaActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodoActual = $_SERVER['REQUEST_METHOD'];

        if($metodoActual === 'GET'){
            $func = $this->getRoutes[$rutaActual] ?? null;
        } else {
            $func = $this->postRoutes[$rutaActual] ?? null;
        }

        if($func){
            call_user_func($func, $this);
        } else {
            echo 'Página no disponible';
            //header('location:/404');
        }
    }

    public function render($view, $datos = []){
        /* Nombramos las variables de forma dinámica */
        foreach($datos as $key => $value){
            $$key = $value;
        }
        /* Almacenamos en memoria temporal */
        ob_start();
        include_once __DIR__ . "/views/$view.php";
        /* Limpiamos el buffer */
        $contenido = ob_get_clean();
        include_once __DIR__ . '/views/layout.php';
    }
}

?>