<?php

namespace MrStronge\SimpleRouter\Exception;

class RouteNotFoundException extends \InvalidArgumentException implements ExceptionInterface
{
    public const MESSAGE = 'Route not found';

    public function __construct(
        string $message = self::MESSAGE,
        int $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}