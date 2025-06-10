<?php
require_once __DIR__ . '/../includes/app.php';

use APP\Router;
use Controllers\HomeController;
use Controllers\ReservaController;
use Controllers\ServicioController;

$router = new Router();
// HOME
$router->get("/", [HomeController::class, 'index']);
$router->get("/404", [HomeController::class, 'notfound']);

// SERVICIOS
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/editar', [ServicioController::class, 'editar']);
$router->post('/servicios/editar', [ServicioController::class, 'editar']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);

// RESERVAS
$router->get('/reservas/crear', [ReservaController::class, 'crear']);

$router->validarRutas();
?>