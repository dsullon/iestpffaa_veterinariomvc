<?php
require_once __DIR__ . '/../includes/app.php';

use APP\Router;
use Controllers\ServicioController;

$router = new Router();
$router->get('/servicios', [ServicioController::class, 'index']);


$router->validarRutas();
?>