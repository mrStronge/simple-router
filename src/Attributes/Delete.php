<?php

namespace MrStronge\SimpleRouter\Attributes;

use MrStronge\SimpleRouter\Enums\RequestMethod;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Delete extends Route
{
    public const METHOD_NAME = 'DELETE';

    public function __construct(
        protected string $path,
    )
    {
        parent::__construct(RequestMethod::DELETE->value, $this->path);
    }
}