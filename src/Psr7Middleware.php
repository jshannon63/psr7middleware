<?php

namespace Jshannon63\Psr7Middleware;

use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\App;
use Closure;

class Psr7Middleware
{

    public function handle($request, Closure $next)
    {
        // go ahead and complete the foundation middleware stack
        // first before running the psr7 middleware stack.
        $response = $next($request);

        // convert foundation request/response objects to PSR-7.
        $psr7Factory = new DiactorosFactory();
        $psrRequest = $psr7Factory->createRequest($request);
        $psrResponse = $psr7Factory->createResponse($response);

        // psr7 middleware dispatcher
        foreach($this->middleware as $middleware){
            $relay[] = new $middleware;
        }
        while(count($relay)){
            $callable = array_shift($relay);
            $psrResponse = $callable($psrRequest, $psrResponse, count($relay)?$relay[0]:null);
        }

        // convert PSR-7 response/request objects back to foundation.
        $httpFoundationFactory = new HttpFoundationFactory();
        return $httpFoundationFactory->createResponse($psrResponse);

    }

}
