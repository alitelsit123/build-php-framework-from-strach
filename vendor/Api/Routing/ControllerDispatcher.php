<?php
namespace Api\Routing;

trait ControllerDispatcher
{
    protected static $Controller;
    public static function getClass()
    {
        if(self::$Controller === null):
            $class = get_called_class();
            self::$Controller = new $class;
        endif;
        return self::$Controller;
    }
}