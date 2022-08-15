# simple-router
This package provides a simple router for php.

## Installation

```bash
composer req mrstronge/simple-router
``` 

## Usage
### index/bootstrap

* create a new instance of the router with your project-namespace as parameter (eg 'vendor\project')
* call the *resolveUrl* method with the request-method and the url to resolve to get the return of the mapped controller-action

```php
# index.php
use MrStronge\SimpleRouter\Router;

include_once(__DIR__ . '/../vendor/autoload.php');

$router = new Router(YOUR_PROJECT_NAMESPACE);
// just echo the return of the mapped controller-action
echo $router->resolveUrl($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
```

### example Controller
* use the given attribute for the request-method (Get, Post, Delete, Patch, Put) and define the url-path

```php
namespace MrStronge\PhpPlayground\Controller;

use MrStronge\SimpleRouter\Attributes\Get;
use MrStronge\SimpleRouter\Attributes\Post;
use MrStronge\SimpleRouter\Attributes\Put;

class ProductController extends AbstractController
{

    #[Get('/products')]
    public function index(): void
    {

    }

    #[Get('/product')]
    public function show(array $args): mixed
    {
        return $args;
    }

}
```

## What's next?
* support for multipart paths with variable segments
* support for multiple request-methods or wildcard-method
* add some tests and replace ugly parts ;-)


