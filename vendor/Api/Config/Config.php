<?php
namespace Api\Config;

class Config
{
    public static $configuration = [];
    public static function set()
    {
        self::$configuration = [
            'url' => require_once '../config/url.php',
            'template' => require_once '../config/template.php',
            'session' => require_once '../config/session.php',
            'database' => require_once '../config/database.php',
        ];
    }
    public static function get($path)
    {
        $p = self::$configuration;
        $path = explode('/', $path);
        foreach($path as $bit)
        {
            if(isset($p[$bit]))
            {
                $p = $p[$bit];
            }
        }
        return $p;
    }
}