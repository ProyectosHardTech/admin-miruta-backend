<?php

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    $app->add(function (Request $request, Response $response1, callable  $next) {
        $response = $response1->withHeader('Content-type', 'application/json;charset=utf-8');
        $next($request, $response);
        return  $response;
    });
};
