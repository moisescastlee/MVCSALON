<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
$router = new Router();

// iniciar sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Recuperar password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);




// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();