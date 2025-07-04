<?php
require_once __DIR__ . '/../includes/app.php';

use API\APIAuth;
use API\APICarrito;
use API\APIProductos;
use API\APIReserva;
use API\APIServicios;
use APP\Router;
use Controllers\AuthController;
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
$router->post('/api/usuarios', [APIAuth::class, 'procesar']);
$router->get('/api/servicios', [APIServicios::class, 'procesar']);
$router->post('/api/servicios', [APIServicios::class, 'procesar']);
$router->get('/api/productos', [APIProductos::class, 'procesar']);
$router->post('/api/productos', [APIProductos::class, 'procesar']);

// AUTH
$router->get("/login", [AuthController::class, 'login']);
$router->get('/auth/registro', [AuthController::class, 'registrar']);
$router->get('/auth/olvide', [AuthController::class, 'olvide']);
$router->get('/auth/confirmar', [AuthController::class, 'confirmar']);

// HOME
$router->get("/", [HomeController::class, 'index']);
$router->get("/nosotros", [HomeController::class, 'nosotros']);
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

// CARRITO
$router->get('/carrito', [CarritoController::class, 'index']);
$router->get('/compra', [CarritoController::class, 'compra']);

$router->validarRutas();
?>