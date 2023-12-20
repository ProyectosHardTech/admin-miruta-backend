<?php

header('Access-Control-Allow-Origin: *');
require_once '../vendor/autoload.php';
require_once '../src/config/database.php';
// controladores
require_once '../src/controllers/empleadoController.php';
require_once '../src/controllers/clienteController.php';
require_once '../src/controllers/choferesController.php';
require_once '../src/controllers/vehiculoController.php';
require_once '../src/controllers/comisionController.php';
require_once '../src/controllers/formaPagoController.php';
require_once '../src/controllers/funcionalidadController.php';
require_once '../src/controllers/historialController.php';
require_once '../src/controllers/dashboardController.php';
// modelos
require_once '../src/models/empleado.php';
require_once '../src/models/cliente.php';
require_once '../src/models/choferes.php';
require_once '../src/models/vehiculo.php';
require_once '../src/models/comision.php';
require_once '../src/models/formaPago.php';
require_once '../src/models/funcionalidad.php';
require_once '../src/models/historial.php';
require_once '../src/models/dashboard.php';

$routes = require '../src/routes/routes.php';
$middleware = require '../src/middleware/middleware.php';
$configuration = [
    'settings' => ['displayErrorDetails' => true],
];
$container = new \Slim\Container($configuration);
$app = new \Slim\App($container);
$middleware($app);
$routes($app);
$app->run();
