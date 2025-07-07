<?php

use Classes\SessionHelper;

function depurar($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function respuestaAPI(bool $estado = false, string $mensaje = "", mixed $data = []){
    $respuesta = [
        'estado' => $estado,
        'mensaje' => $mensaje,
        'data' => $data
    ];
    return $respuesta;
}

// Función que revisa que el usuario este autenticado
function isAuth() : void {
    $login = SessionHelper::has('login');
    if(!isset($login)) {
        header('Location: /login');
    }
}