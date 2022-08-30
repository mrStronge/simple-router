<?php

namespace MrStronge\SimpleRouter\Enums;

enum RequestMethod: string
{
    case CONNECT = 'CONNECT';
    case DELETE = 'DELETE';
    case GET = 'GET';
    case HEAD = 'HEAD';
    case OPTION = 'OPTION';
    case PATCH = 'PATCH';
    case POST = 'POST';
    case PUT = 'PUT';
    case TRACE = 'TRACE';
}