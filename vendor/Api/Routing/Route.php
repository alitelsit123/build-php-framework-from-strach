<?php
namespace Api\Routing;

class Route
{
    public static function get($uri, $action)
    {
        Router::getClass()->addRoute('GET', $uri, $action);
    }
    public static function post($uri, $action)
    {
        Router::getClass()->addRoute('POST', $uri, $action);
    }
}