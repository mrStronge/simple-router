<?php

namespace MrStronge\SimpleRouter\Tests\Double;

use MrStronge\SimpleRouter\Attributes\Get;
use MrStronge\SimpleRouter\Attributes\Post;

class TestController {

    #[Get('/')]
    public function index(): string {
        return 'index';
    }

    #[Get('/show/{id}')]
    public function showById(array $args): string {
        return 'show ' . $args['id'];
    }

    #[Post('/update/{id}')]
    public function updateById(array $args): string {
        return 'update ' . $args['id'];
    }

    #[Get('/list')]
    public function list(): string {
        return 'list';
    }
}