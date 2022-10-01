<?php

namespace MrStronge\SimpleRouter\Tests;

use PHPUnit\Framework\TestCase;
use MrStronge\SimpleRouter\Router;
use MrStronge\SimpleRouter\Tests\Double\TestController;

class RouterTest extends TestCase
{
    protected Router $router;
    protected TestController $controller;

    public function setUp(): void
    {
        $this->router = Router::get('MrStronge\SimpleRouter\Tests');
        $this->controller = new TestController();
    }

    public function testInstance(): void
    {
        $this->assertInstanceOf(Router::class, $this->router);

        $newInstance = Router::get('Vendor/Package');
        $this->assertSame($this->router, $newInstance);
    }

    public function testRegisterRoutesOfClass(): void
    {
        $this->assertEquals($this->getRoutesRegister(), $this->router->getRoutes());
    }

    public function testResolveRequest(): void
    {
        $this->assertEquals('index', $this->router->resolveRequest('GET', '/'));
        $this->assertEquals('show 123', $this->router->resolveRequest('GET', '/show/123'));
        $this->assertEquals('update 123', $this->router->resolveRequest('POST', '/update/123'));
        $this->assertEquals('list', $this->router->resolveRequest('GET', '/list'));
    }

    private function getRoutesRegister(): array
    {
        return [
            'GET' => [
                '/' => [
                    'MrStronge\SimpleRouter\Tests\Double\TestController',
                    'index'
                ],
                '/show/{id}' => [
                    'MrStronge\SimpleRouter\Tests\Double\TestController',
                    'showById'
                ],
                '/list' => [
                    'MrStronge\SimpleRouter\Tests\Double\TestController',
                    'list'
                ]
            ],
            'POST' => [
                '/update/{id}' => [
                    'MrStronge\SimpleRouter\Tests\Double\TestController',
                    'updateById'
                ]
            ]
        ];
    }
}
