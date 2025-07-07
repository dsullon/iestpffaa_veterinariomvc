<?php

function depurar($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    //exit;
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
    if(!isset($_SESSION['login'])) {
        header('Location: /login');
    }
}