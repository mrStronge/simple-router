# simple-router
This package provides a simple router for php and supports all http-methods.

## Installation

```bash
composer req mrstronge/simple-router
``` 

## Usage
### index/bootstrap

* Create a new instance of the router with your project-namespace as parameter. 
   `$router = MrStronge\SimpleRouter\Router::get('VENDOR\PROJECT_NAMESPACE');`
* Just call `$router()` as function, to get the return pf the mapped controller method.

```php
# index.php 
<?php

include_once(__DIR__ . '/../vendor/autoload.php');

// get instance of router and "register namespace"
$router = MrStronge\SimpleRouter\Router::get('VENDOR\PROJECT_NAMESPACE');
try {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($router());
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

### example Controller
* Use the given attribute for the request-method (Get, Post, Delete, Patch, Put) and define the url-path.
* you can set placeholders for variable parts like ids or names.

```php
namespace MrStronge\PhpPlayground\Controller;

use MrStronge\SimpleRouter\Attributes\Get;
use MrStronge\SimpleRouter\Attributes\Post;
use MrStronge\SimpleRouter\Attributes\Put;
use MrStronge\SimpleRouter\Attributes\Patch;
use MrStronge\SimpleRouter\Attributes\Delete;

class ProductController extends AbstractController
{

    #[Get('/products')]
    public function index(): mixed
    {
        return [];
    }

    #[Get('/product')]
    public function show(array $args): mixed
    {
        return $args;
    }

    #[Get('/product/{id}')]
    public function showByID(array $args): mixed
    {
        return $args;
    }

    #[Get('/product/{id}/subproduct/{subid}')]
    public function showByIdAndSubId(array $args): mixed
    {
        return $args;
    }

    #[Post('/product')]
    public function store(array $args): mixed
    {
        return $args;
    }

    #[Put('/product')]
    public function update(array $args): mixed
    {
        return $args;
    }
}
```

## What's next?
* support for regular expressions in the url-path
* support for multiple request-methods or wildcard-method
* add some tests and replace ugly parts ;-)


