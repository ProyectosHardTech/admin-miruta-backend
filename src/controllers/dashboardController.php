<?php

namespace App\Controllers;

use App\models\Dashboard;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DashboardController
{
    private $Dashboard;
    function __construct()
    {
        $this->Dashboard = new Dashboard();
    }
    function getViajesTaxi(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Dashboard->getViajesTaxi($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getViajesInterprovincial(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Dashboard->getViajesInterprovincial($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getViajesCargaPesada(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Dashboard->getViajesCargaPesada($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getTotalChofer(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Dashboard->getTotalChofer($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getTotalRecargas(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Dashboard->getTotalRecargas($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getComisionXDinero(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Dashboard->getComisionXDinero($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
}