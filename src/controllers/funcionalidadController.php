<?php

namespace App\Controllers;

use App\models\funcionalidad;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FuncionalidadController
{
    private $funcionalidad;
    function __construct()
    {
        $this->funcionalidad = new Funcionalidad();
    }
    function getFuncionalidadA(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->funcionalidad->getFuncionalidadA($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getFuncionalidadI(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->funcionalidad->getFuncionalidadI($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function deactivateFuncionalidad(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->funcionalidad->deactivateFuncionalidad($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
}
