<?php


use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Controllers\EmpleadoController;
use App\Controllers\ClienteController;
use app\Controllers\ChoferesController;
use app\Controllers\VehiculoController;
use app\Controllers\ComisionController;
use app\Controllers\formaPagoController;
use App\Controllers\funcionalidadController;
use App\Controllers\HistorialController;
use App\Controllers\DashboardController;


return function (App $app) {
    //PRUEBA
    $app->get('/prueba', function (Request $request, Response $response) {
        echo 'prueba';
    });
    //LOGIN
    $app->post('/login', function (Request $request, Response $response, array $args) {
        $empleadoController = new EmpleadoController();
        $empleadoController->login($request, $response, $args);
    });
    $app->post('/registroEmpleado', function (Request $request, Response $response, array $args) {
        $empleadoController = new EmpleadoController();
        $empleadoController->registro($request, $response, $args);
    });
    $app->get('/getEmpleadoA', function (Request $request, Response $response, array $args) {
        $empleadoController = new EmpleadoController();
        $empleadoController->getEmpleadoA($request, $response, $args);
    });
    $app->get('/getEmpleadoD', function (Request $request, Response $response, array $args) {
        $empleadoController = new EmpleadoController();
        $empleadoController->getEmpleadoD($request, $response, $args);
    });
    $app->post('/getModuloEmpleado', function (Request $request, Response $response, array $args) {
        $empleadoController = new EmpleadoController();
        $empleadoController->getModuloEmpleado($request, $response, $args);
    });
    $app->post('/deactivateEmpleado', function (Request $request, Response $response, array $args) {
        $empleadoController = new EmpleadoController();
        $empleadoController->deactivateEmpleado($request, $response, $args);
    });
    $app->post('/udpdateEmpleado', function (Request $request, Response $response, array $args) {
        $empleadoController = new EmpleadoController();
        $empleadoController->udpdateEmpleado($request, $response, $args);
    });
    $app->post('/controlModulos', function (Request $request, Response $response, array $args) {
        $empleadoController = new EmpleadoController();
        $empleadoController->controlModulos($request, $response, $args);
    }); 

    // RUTAS CLIENTES

    $app->get('/getClientesA', function (Request $request, Response $response, array $args) {
        $clienteController = new ClienteController();
        $clienteController->getClientesA($request, $response, $args);
    }); 
    $app->get('/getClientesD', function (Request $request, Response $response, array $args) {
        $clienteController = new ClienteController();
        $clienteController->getClientesD($request, $response, $args);
    });
    $app->post('/deactivateCliente', function (Request $request, Response $response, array $args) {
        $clienteController = new ClienteController();
        $clienteController->deactivateCliente($request, $response, $args);
    }); 
    $app->post('/detalleCliente', function (Request $request, Response $response, array $args) {
        $clienteController = new ClienteController();
        $clienteController->detalleCliente($request, $response, $args);
    }); 
    $app->post('/updateCliente', function (Request $request, Response $response, array $args) {
        $clienteController = new ClienteController();
        $clienteController->updateCliente($request, $response, $args);
    });
    // rutas Choferes
    $app->get('/getChoferesP', function (Request $request, Response $response, array $args) {
        $ChoferesController = new ChoferesController();
        $ChoferesController->getChoferesP($request, $response, $args);
    });
    $app->get('/getChoferesA', function (Request $request, Response $response, array $args) {
        $ChoferesController = new ChoferesController();
        $ChoferesController->getChoferesA($request, $response, $args);
    });
    $app->get('/getChoferesD', function (Request $request, Response $response, array $args) {
        $ChoferesController = new ChoferesController();
        $ChoferesController->getChoferesD($request, $response, $args);
    });
    $app->get('/getChoferesO', function (Request $request, Response $response, array $args) {
        $ChoferesController = new ChoferesController();
        $ChoferesController->getChoferesO($request, $response, $args);
    });
    $app->get('/getChoferesC', function (Request $request, Response $response, array $args) {
        $ChoferesController = new ChoferesController();
        $ChoferesController->getChoferesC($request, $response, $args);
    });
    $app->post('/getDocChofer', function (Request $request, Response $response, array $args) {
        $ChoferesController = new ChoferesController();
        $ChoferesController->getDocChofer($request, $response, $args);
    });
    $app->post('/deactivateChofer', function (Request $request, Response $response, array $args) {
        $ChoferesController = new ChoferesController();
        $ChoferesController->deactivateChofer($request, $response, $args);
    });
    $app->post('/docValidador', function (Request $request, Response $response, array $args) {
        $ChoferesController = new ChoferesController();
        $ChoferesController->docValidador($request, $response, $args);
    });
    $app->post('/getDocObservados', function (Request $request, Response $response, array $args) {
        $ChoferesController = new ChoferesController();
        $ChoferesController->getDocObservados($request, $response, $args);
    });
    $app->post('/rechazarPendientes', function (Request $request, Response $response, array $args) {
        $ChoferesController = new ChoferesController();
        $ChoferesController->rechazarPendientes($request, $response, $args);
    });
    $app->get('/getChoferesR', function (Request $request, Response $response, array $args) {
        $ChoferesController = new ChoferesController();
        $ChoferesController->getChoferesR($request, $response, $args);
    });
    //rutas vehiculos
    $app->get('/getMarca', function (Request $request, Response $response, array $args) {
        $VehiculoController = new VehiculoController();
        $VehiculoController->getMarca($request, $response, $args);
    });
    $app->get('/getModeloT', function (Request $request, Response $response, array $args) {
        $VehiculoController = new VehiculoController();
        $VehiculoController->getModeloT($request, $response, $args);
    });
    $app->get('/getModeloA', function (Request $request, Response $response, array $args) {
        $VehiculoController = new VehiculoController();
        $VehiculoController->getModeloA($request, $response, $args);
    });
    $app->get('/getModeloD', function (Request $request, Response $response, array $args) {
        $VehiculoController = new VehiculoController();
        $VehiculoController->getModeloD($request, $response, $args);
    });
    $app->post('/addMarca', function (Request $request, Response $response, array $args) {
        $VehiculoController = new VehiculoController();
        $VehiculoController->addMarca($request, $response, $args);
    });
    $app->post('/addModelo', function (Request $request, Response $response, array $args) {
        $VehiculoController = new VehiculoController();
        $VehiculoController->addModelo($request, $response, $args);
    });
    $app->post('/updateModelo', function (Request $request, Response $response, array $args) {
        $VehiculoController = new VehiculoController();
        $VehiculoController->updateModelo($request, $response, $args);
    });
    $app->post('/updateMarca', function (Request $request, Response $response, array $args) {
        $VehiculoController = new VehiculoController();
        $VehiculoController->updateMarca($request, $response, $args);
    });
    $app->post('/deactivateModelo', function (Request $request, Response $response, array $args) {
        $VehiculoController = new VehiculoController();
        $VehiculoController->deactivateModelo($request, $response, $args);
    });
    $app->get('/getTipoVehiculo', function (Request $request, Response $response, array $args) {
        $VehiculoController = new VehiculoController();
        $VehiculoController->getTipoVehiculo($request, $response, $args);
    });
    // rutas comision
    $app->get('/getComision', function (Request $request, Response $response, array $args) {
        $ComisionController = new ComisionController();
        $ComisionController->getComision($request, $response, $args);
    });
    $app->post('/updateComision', function (Request $request, Response $response, array $args) {
        $ComisionController = new ComisionController();
        $ComisionController->updateComision($request, $response, $args);
    });
    // RUTAS DE FORMA DE PAGOS
    $app->get('/getformaPagoA', function (Request $request, Response $response, array $args) {
        $FormaPagoController = new FormaPagoController();
        $FormaPagoController->getformaPagoA($request, $response, $args);
    });
    $app->get('/getformaPagoD', function (Request $request, Response $response, array $args) {
        $FormaPagoController = new FormaPagoController();
        $FormaPagoController->getformaPagoD($request, $response, $args);
    });
    $app->post('/deactivateFormaPago', function (Request $request, Response $response, array $args) {
        $FormaPagoController = new FormaPagoController();
        $FormaPagoController->deactivateFormaPago($request, $response, $args);
    });
    $app->get('/getFuncionalidadA', function (Request $request, Response $response, array $args) {
        $FormaPagoController = new FuncionalidadController();
        $FormaPagoController->getFuncionalidadA($request, $response, $args);
    });
    
    // rutas de funcionalidad
    $app->get('/getFuncionalidadI', function (Request $request, Response $response, array $args) {
        $FormaPagoController = new FuncionalidadController();
        $FormaPagoController->getFuncionalidadI($request, $response, $args);
    });
    $app->post('/deactivateFuncionalidad', function (Request $request, Response $response, array $args) {
        $FormaPagoController = new FuncionalidadController();
        $FormaPagoController->deactivateFuncionalidad($request, $response, $args);
    });
    // rutas de historial

    $app->get('/getHistorialPagos', function (Request $request, Response $response, array $args) {
        $HistorialController = new HistorialController();
        $HistorialController->getHistorialPagos($request, $response, $args);
    });
    $app->get('/getHistorialViajesChofer', function (Request $request, Response $response, array $args) {
        $HistorialController = new HistorialController();
        $HistorialController->getHistorialViajesChofer($request, $response, $args);
    });
    $app->get('/getHistorialViajesCliente', function (Request $request, Response $response, array $args) {
        $HistorialController = new HistorialController();
        $HistorialController->getHistorialViajesCliente($request, $response, $args);
    });
    $app->post('/getHistorialViajesXchofer', function (Request $request, Response $response, array $args) {
        $HistorialController = new HistorialController();
        $HistorialController->getHistorialViajesXchofer($request, $response, $args);
    });
    $app->post('/getHistorialViajesXcliente', function (Request $request, Response $response, array $args) {
        $HistorialController = new HistorialController();
        $HistorialController->getHistorialViajesXcliente($request, $response, $args);
    });

    // rutas de dashboar
    $app->get('/getViajesTaxi', function (Request $request, Response $response, array $args) {
        $DashboardController = new DashboardController();
        $DashboardController->getViajesTaxi($request, $response, $args);
    });
    $app->get('/getViajesInterprovincial', function (Request $request, Response $response, array $args) {
        $DashboardController = new DashboardController();
        $DashboardController->getViajesInterprovincial($request, $response, $args);
    });
    $app->get('/getViajesCargaPesada', function (Request $request, Response $response, array $args) {
        $DashboardController = new DashboardController();
        $DashboardController->getViajesCargaPesada($request, $response, $args);
    });
    $app->get('/getTotalChofer', function (Request $request, Response $response, array $args) {
        $DashboardController = new DashboardController();
        $DashboardController->getTotalChofer($request, $response, $args);
    });
    $app->get('/getTotalRecargas', function (Request $request, Response $response, array $args) {
        $DashboardController = new DashboardController();
        $DashboardController->getTotalRecargas($request, $response, $args);
    });
    $app->get('/getComisionXDinero', function (Request $request, Response $response, array $args) {
        $DashboardController = new DashboardController();
        $DashboardController->getComisionXDinero($request, $response, $args);
    });
};
