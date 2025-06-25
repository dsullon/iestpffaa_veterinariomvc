<?php
require_once __DIR__ . '/../includes/app.php';

use API\APICarrito;
use API\APIReserva;
use APP\Router;
use Controllers\CarritoController;
use Controllers\HomeController;
use Controllers\ProductoController;
use Controllers\ReservaController;
use Controllers\ServicioController;

$router = new Router();
// API
$router->get('/api/reservas', [APIReserva::class, 'procesar']);
$router->post('/api/reservas', [APIReserva::class, 'procesar']);
$router->get('/api/carrito', [APICarrito::class, 'procesar']);
$router->post('/api/carrito', [APICarrito::class, 'procesar']);
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

$router->get('/carrito', [CarritoController::class, 'index']);

$router->validarRutas();
?>