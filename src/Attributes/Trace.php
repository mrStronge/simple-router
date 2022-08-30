<?php

namespace MrStronge\SimpleRouter\Attributes;

use MrStronge\SimpleRouter\Enums\RequestMethod;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Trace extends Route
{
    public function __construct(
        protected string $path,
    )
    {
        parent::__construct(RequestMethod::TRACE->value, $this->path);
    }
}