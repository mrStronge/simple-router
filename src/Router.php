<?php

namespace MrStronge\SimpleRouter;

use Exception;
use MrStronge\SimpleRouter\Exception\RouteNotFoundException;
use MrStronge\SimpleRouter\Attributes\Route;
use HaydenPierce\ClassFinder\ClassFinder;
use MrStronge\SimpleRouter\Utility\ArgumentUtility;

class Router
{
    public const ARG_REGEX_PATTERN = '/\{[a-z|0-9]*\}/';
    public const ARG_REGEX_PATTERN_REPLACE = '?[a-z|0-9]{1,}';

    protected array $routes = [];

    public function __construct(protected string $namespace)
    {
        $this->init();
    }

    /**
     * Initialize class- and route registration.
     *
     * @throws \ReflectionException
     */
    public function init(): array
    {
        $classes = $this->getClassesByNamespace();

        foreach ($classes as $class) {
            $this->registerRoutesOfClass($class);
        }

        return $this->routes;
    }

    /**
     * Get classes by namespace.
     *
     * @throws Exception
     */
    private function getClassesByNamespace(): array
    {
        $classes = ClassFinder::getClassesInNamespace($this->namespace, ClassFinder::RECURSIVE_MODE);

        return array_filter($classes, function ($class) {
            return class_exists($class);
        });
    }

    /**
     * Register routes of given class.
     *
     * @throws \ReflectionException
     */
    private function registerRoutesOfClass(string $class): void
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
     * Compare given url with registered routes and build arguments-array.
     * Handle exceptions if route not found.
     *
     * @throws Exception
     */
    public function resolveUrl(string $requestMethod = '', string $url = ''): mixed
    {
        $requestMethod = (!empty($requestMethod)) ? $requestMethod : $_SERVER['REQUEST_METHOD'];
        $url = (!empty($url)) ? $url : $_SERVER['REQUEST_URI'];

        $requestUri = explode('?', $url);
        $urlPath = '/' . trim($requestUri[0], '/');

        foreach ($this->routes[$requestMethod] as $route => $mapping) {
            $regex = preg_replace(static::ARG_REGEX_PATTERN, static::ARG_REGEX_PATTERN_REPLACE, $route);
            $regex = str_replace('/', '\/', $regex);
            if (preg_match_all('/^' . $regex . '$/', $urlPath)) {
                $arguments = ArgumentUtility::mapPathsToArguments($route, $urlPath);
                return $this->call($mapping[0], $mapping[1], $arguments);
            }
        }

        throw new RouteNotFoundException();
    }

    /**
     * Call the registered controller-method.
     *
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