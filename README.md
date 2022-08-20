# simple-router
This package provides a simple router for php.

## Installation

```bash
composer req mrstronge/simple-router
``` 

## Usage
### index/bootstrap

* Create a new instance of the router with your project-namespace as parameter (eg 'vendor\project')
* Call the `resolveUrl` method to get the return of the mapped controller-action. 
  You can pass an optional request-method or -url. By default, the `resolveUrl` method uses `$_SERVER['REQUEST_METHOD']` and `$_SERVER['REQUEST_URI']`.

```php
# index.php
use MrStronge\SimpleRouter\Router;

include_once(__DIR__ . '/../vendor/autoload.php');

$router = new Router(YOUR_PROJECT_NAMESPACE);
// just echo the return of the mapped controller-action
echo $router->resolveUrl();
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
* support for multipart paths with variable segments
* support for multiple request-methods or wildcard-method
* add some tests and replace ugly parts ;-)


