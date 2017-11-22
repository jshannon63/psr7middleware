<?php

namespace App\Http\Middleware;

use Jshannon63\Psr7Middleware\Psr7Middleware as Middleware;

class Psr7Middleware extends Middleware
{


    protected $middleware = [

        \Jshannon63\Psr7Middleware\exampleMiddleware::class,

    ];


}
