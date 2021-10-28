<?php
namespace Api\Routing; 

class BaseController
{
    use ControllerDispatcher;
    public function __innerMethod(\Closure $action)
    {
        return $action;
    }
}