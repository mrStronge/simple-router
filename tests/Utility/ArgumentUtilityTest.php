<?php

namespace MrStronge\SimpleRouter\Tests\Utility;

use PHPUnit\Framework\TestCase;
use MrStronge\SimpleRouter\Utility\ArgumentUtility;

class ArgumentUtilityTest extends TestCase
{
    /**
     * @dataProvider mapPathDataprovider
     * @covers ArgumentUtility::mapPathsToArguments
     */
    public function testMapPathsToArguments($route, $path, $expected): void
    {
        $this->assertEquals($expected, ArgumentUtility::mapPathsToArguments($route, $path));
    }


    public function mapPathDataprovider(): \Generator
    {
        yield 'empty path' => [
            'route' => '/',
            'urlPath' => '/',
            'expected' => []
        ];

        yield 'simple path with one argument' => [
            'route' => '/test/{id}',
            'urlPath' => '/test/123',
            'expected' => ['id' => '123']
        ];

        yield 'path with two arguments' => [
            'route' => '/test/{id}/sub/{subId}',
            'urlPath' => '/test/123/sub/456',
            'expected' => [
                'id' => '123',
                'subId' => '456'
            ]
        ];
    }
}