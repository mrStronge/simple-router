<?php

namespace MrStronge\SimpleRouter\Tests;

use PHPUnit\Framework\TestCase;
use MrStronge\SimpleRouter\Router;

class RouterTest extends TestCase
{
    protected Router $router;

    public function setUp(): void
    {
        $this->router = Router::getInstance();
    }
}
