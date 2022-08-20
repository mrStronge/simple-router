<?php

namespace MrStronge\SimpleRouter\Utility;

class ArgumentUtility
{
    /**
     * Merge route and called url-path to map argument-titles to its values
     */
    public static function mapPathsToArguments($route, $urlPath): array
    {
        $route = explode('/', trim($route, '/'));
        $urlPath = explode('/', trim($urlPath, '/'));

        $arguments = array_combine($urlPath, $route);

        // filter array-entries with parenthesis (placeholder argument-key)
        $arguments = array_filter($arguments, function ($value) {
            return strpos($value, '{') !== false;
        });

        // replace parenthesis
        $arguments = array_map(function ($item) {
            return str_replace(['{', '}'], '', $item);
        }, $arguments);

        // flip array to return argument-key as array-key
        return array_flip($arguments);
    }
}