<?php

namespace App\Controllers;

use App\models\Vehiculo;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VehiculoController
{
    private $Vehiculo;
    function __construct()
    {
        $this->Vehiculo = new Vehiculo();
    }
    function getMarca(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Vehiculo->getMarca($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getModeloT(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Vehiculo->getModeloT($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getModeloA(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Vehiculo->getModeloA($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getModeloD(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Vehiculo->getModeloD($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function addMarca(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Vehiculo->addMarca($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function addModelo(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Vehiculo->addModelo($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function updateMarca(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Vehiculo->updateMarca($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function updateModelo(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Vehiculo->updateModelo($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function deactivateModelo(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Vehiculo->deactivateModelo($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getTipoVehiculo(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Vehiculo->getTipoVehiculo($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
}