<?php

namespace App\Controllers;

use App\models\Cliente;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ClienteController
{
    private $cliente;
    function __construct()
    {
        $this->cliente = new Cliente();
    }
    function getClientesA(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->cliente->getClientesA($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getClientesD(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->cliente->getClientesD($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function deactivateCliente(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->cliente->deactivateCliente($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function detalleCliente(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->cliente->detalleCliente($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function updateCliente(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->cliente->updateCliente($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
}