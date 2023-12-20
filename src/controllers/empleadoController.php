<?php

namespace App\Controllers;

use App\models\Empleado;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EmpleadoController
{
    private $empleado;
    function __construct()
    {
        $this->empleado = new Empleado();
    }
    function login(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->empleado->login($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function registro(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->empleado->registro($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getEmpleadoA(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->empleado->getEmpleadoA($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getEmpleadoD(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->empleado->getEmpleadoD($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getModuloEmpleado(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->empleado->getModuloEmpleado($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function deactivateEmpleado(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->empleado->deactivateEmpleado($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function udpdateEmpleado(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->empleado->udpdateEmpleado($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function controlModulos(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->empleado->controlModulos($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }

}
