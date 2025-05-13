<?php
require_once __DIR__ . '/../includes/app.php';

use APP\Router;
use Controllers\HomeController;
use Controllers\ServicioController;

$router = new Router();
// GENERALES
$router->get("/404", [HomeController::class, 'notfound']);

// SERVICIOS
$router->get('/servicios', [ServicioController::class, 'index']);


$router->validarRutas();
?>