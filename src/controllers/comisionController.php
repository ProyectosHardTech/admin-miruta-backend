<?php

namespace App\Controllers;

use App\models\Comision;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ComisionController
{
    private $Comision;
    function __construct()
    {   
        $this->Comision = new Comision();
    }
    function getComision(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Comision->getComision($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function updateComision(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->Comision->updateComision($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
}