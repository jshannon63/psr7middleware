<?php

use Jshannon63\Psr7Middleware\Psr7Middleware;
use PHPUnit\Framework\TestCase;


class Psr7MiddlewareTest extends TestCase
{
    public function test_nothing(){
        $this->assertTrue(1==1);
    }
}