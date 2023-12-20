<?php

namespace App\Controllers;

use App\models\FormaPago;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FormaPagoController
{
    private $FormaPago;
    function __construct()
    {   
        $this->FormaPago = new FormaPago();
    }
    function getformaPagoA(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->FormaPago->getformaPagoA($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function getformaPagoD(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->FormaPago->getformaPagoD($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
    function deactivateFormaPago(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $data = $this->FormaPago->deactivateFormaPago($request);
        $response->getBody()->write(json_encode($data),  JSON_UNESCAPED_UNICODE);
    }
}