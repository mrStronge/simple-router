<?php

namespace MrStronge\SimpleRouter\Attributes;

use MrStronge\SimpleRouter\Enums\RequestMethod;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Get extends Route
{
    public function __construct(
        protected string $path,
    )
    {
        parent::__construct(RequestMethod::GET->value, $this->path);
    }
}