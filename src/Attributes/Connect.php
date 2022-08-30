<?php

namespace MrStronge\SimpleRouter\Attributes;

use MrStronge\SimpleRouter\Enums\RequestMethod;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Connect extends Route
{
    public function __construct(
        protected string $path,
    )
    {
        parent::__construct(RequestMethod::CONNECT->value, $this->path);
    }
}