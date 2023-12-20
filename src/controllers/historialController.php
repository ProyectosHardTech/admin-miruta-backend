<?php

namespace App\Controllers;

use App\models\Historial;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HistorialController
{
    private $historial;
    function __construct()
    {
        $this->historial = new Historial();
    }
    function getHistorialPagos(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->historial->getHistorialPagos($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getHistorialViajesChofer(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->historial->getHistorialViajesChoferes($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getHistorialViajesCliente(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->historial->getHistorialViajesClientes($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getHistorialViajesXchofer(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->historial->getHistorialViajesXchofer($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getHistorialViajesXcliente(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->historial->getHistorialViajesXcliente($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
}