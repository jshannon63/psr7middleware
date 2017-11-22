<?php

namespace Jshannon63\Psr7Middleware;

use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Relay\RelayBuilder;
use Closure;

class Psr7Middleware
{

    public function handle($request, Closure $next)
    {
        // execute the foundation middleware stack to get the
        // response before running the psr7 middleware stack.
        $response = $next($request);

        $resolver = function ($class) {
            return new $class();
        };

        $relayBuilder = new RelayBuilder($resolver);
        $relay = $relayBuilder->newInstance($this->middleware);

        // convert foundation request/response objects to PSR-7.
        $psr7Factory = new DiactorosFactory();
        $psrRequest = $psr7Factory->createRequest($request);
        $psrResponse = $psr7Factory->createResponse($response);

        // process the middleware stack using relay
        $response = $relay($psrRequest, $psrResponse);

        // convert PSR-7 response/request objects back to foundation and return.
        $httpFoundationFactory = new HttpFoundationFactory();
        return $httpFoundationFactory->createResponse($psrResponse);
    }

}
