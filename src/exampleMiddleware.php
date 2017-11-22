<?php

namespace Jshannon63\Psr7Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

class exampleMiddleware
{
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        if ($next) {
            $response = $next($request, $response);
        }

        // analyze and/or modify your request/response objects
        // here using PSR-7 methods. Example:
        // $response->getBody()->write("<h1>PSR-7 Middleware Rocks!</h1>");

        return $response;
    }
}