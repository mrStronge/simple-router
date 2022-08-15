<?php

namespace MrStronge\SimpleRouter\Attributes;

#[\Attribute]
class Route
{
    public function __construct(
        protected string $method,
        protected string $path,
    )
    {
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}