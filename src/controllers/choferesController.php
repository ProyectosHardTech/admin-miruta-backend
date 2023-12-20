<?php

namespace App\Controllers;

use App\models\Choferes;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ChoferesController
{
    private $choferes;
    function __construct()
    {
        $this->choferes = new Choferes();
    }
    function getChoferesP(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->choferes->getChoferesP($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getChoferesA(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->choferes->getChoferesA($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getChoferesD(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->choferes->getChoferesD($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getChoferesO(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->choferes->getChoferesO($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getChoferesR(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->choferes->getChoferesR($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getChoferesC(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->choferes->getChoferesC($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getDocChofer(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->choferes->getDocChofer($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function deactivateChofer(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->choferes->deactivateChofer($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function docValidador(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->choferes->docValidador($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getDocObservados(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->choferes->getDocObservados($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function rechazarPendientes(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->choferes->rechazarPendientes($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
}