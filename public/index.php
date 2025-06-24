<?php
require_once __DIR__ . '/../includes/app.php';

use API\APIReserva;
use APP\Router;
use Controllers\HomeController;
use Controllers\ProductoController;
use Controllers\ReservaController;
use Controllers\ServicioController;

$router = new Router();
// API
$router->get('/api/reservas', [APIReserva::class, 'procesar']);
$router->post('/api/reservas', [APIReserva::class, 'procesar']);
// HOME
$router->get("/", [HomeController::class, 'index']);
$router->get("/404", [HomeController::class, 'notfound']);

// SERVICIOS
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/editar', [ServicioController::class, 'editar']);
$router->post('/servicios/editar', [ServicioController::class, 'editar']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);

// PRODUCTOS
$router->get('/productos', [ProductoController::class, 'index']);

// RESERVAS
$router->get('/reservas/crear', [ReservaController::class, 'crear']);

$router->validarRutas();
?>