<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */

require __DIR__.'/vendor/autoload.php';

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');
/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'LoginController', 'action' => 'index']);
$router->add('login', ['controller' => 'LoginController', 'action' => 'index']);
$router->add('auth', ['controller' => 'LoginController', 'action' => 'login']);
$router->add('logout', ['controller' => 'LoginController', 'action' => 'logout']);
$router->add('dashboard', ['controller' => 'DashboardController', 'action' => 'index']);
$router->add('plantadatas', ['controller' => 'PlantaDataController', 'action' => 'index']);
$router->add('projects', ['controller' => 'ProjectController', 'action' => 'index']);
$router->add('users', ['controller' => 'UserController', 'action' => 'index']);
$router->add('paises', ['controller' => 'PaisController', 'action' => 'index']);
$router->add('plantas', ['controller' => 'PlantaController', 'action' => 'index']);
$router->add('scraps', ['controller' => 'ScrapController', 'action' => 'index']);
$router->add('reports', ['controller' => 'ReportController', 'action' => 'index']);
$router->add('modelos', ['controller' => 'ModeloController', 'action' => 'index']);
$router->add('lineas', ['controller' => 'LineaController', 'action' => 'index']);

$router->add('centros', ['controller' => 'CentroController', 'action' => 'index']);

$router->add('categorias', ['controller' => 'CategoryController', 'action' => 'index']);
$router->add('graficas', ['controller' => 'GraficaController', 'action' => 'index']);
$router->add('graficas/saveGrafic', ['controller' => 'GraficaController', 'action' => 'saveGrafic']);
$router->add('graficas/datas', ['controller' => 'GraficaController', 'action' => 'datas']);
$router->add('graficas/create', ['controller' => 'GraficaController', 'action' => 'create']);
$router->add('incidencias', ['controller' => 'IncidenciaController', 'action' => 'index']);

$router->add('seguimieto_incidencias', ['controller' => 'IncidenciaController', 'action' => 'seguimiento']);
$router->add('seguimiento_incidencias/create', ['controller' => 'IncidenciaController', 'action' => 'seguimientoCreate']);
$router->dispatch($_SERVER['QUERY_STRING']);
