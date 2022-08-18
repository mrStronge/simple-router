<?php

namespace MrStronge\SimpleRouter;

use Exception;
use MrStronge\SimpleRouter\Exception\RouteNotFoundException;
use MrStronge\SimpleRouter\Attributes\Route;
use HaydenPierce\ClassFinder\ClassFinder;

class Router
{
    /**
     * @var array
     */
    protected array $routes = [];

    public function __construct(protected string $namespace)
    {
        $this->init();
    }

    public function init(): array
    {
        $classes = $this->getClassesByNamespace();

        foreach ($classes as $class) {
            $this->registerRoutesOfClass($class);
        }

        return $this->routes;
    }

    // get classes by folder
    private function getClassesByNamespace(): array
    {

        $classes = ClassFinder::getClassesInNamespace($this->namespace, ClassFinder::RECURSIVE_MODE);

        return array_filter($classes, function ($possibleClass) {
            return class_exists($possibleClass);
        });
    }

    // get Routes by Class-Array
    private function registerRoutesOfClass(string $class)
    {
        $reflection = new \ReflectionClass($class);
        $methods = $reflection->getMethods();

        foreach ($methods as $method) {
            $attributes = $method->getAttributes(Route::class, \ReflectionAttribute::IS_INSTANCEOF);
            foreach ($attributes as $attribute) {
                /** @var Route $route */
                $route = $attribute->newInstance();
                $this->routes[$route->getMethod()][$route->getPath()] = [$reflection->getName(), $method->getName()];
            }
        }
    }

    /**
     * @throws Exception
     */
    public function resolveUrl($requestMethod, $url): mixed
    {
        $requestUri = explode('?', $url);
        $route = trim($requestUri[0], '/');

        echo $route.'<br>';

        foreach ($this->routes[$requestMethod] as $path => $mapping) {
            echo $path . ' - ';
            $regex = preg_replace('/\{[a-z|0-9]*\}/', '?[a-z|0-9]{1,}', $path);
            echo $regex.'<br>';
        }

        throw new RouteNotFoundException();
    }

    /**
     * @throws RouteNotFoundException
     */
    protected function call($controller, $method, array $arguments = []): mixed
    {
        if (!class_exists('\\' . $controller)) {
            throw new RouteNotFoundException('Controller not found');
        }

        $instance = new ('\\' . $controller);

        if (!is_callable([$instance, $method])) {
            throw new RouteNotFoundException('Method not callable');
        }

        return call_user_func([$instance, $method], $arguments);
    }

}