<?php
namespace Api\Http;
use Api\Config\Config;
class Session
{
    public function __construct()
    {
        session_start();
    }
    public static function set($prefix, $key, $value)
    {
        if(self::hasPrefix($prefix))
        {
            // echo $key;
            $_SESSION[$prefix][$key] = $value;
            return;
        }
        else
        {
            $_SESSION[$prefix] = Config::get('session/' . $prefix);
            $_SESSION[$prefix][$key] = $value;
            return;
        }
    }
    public static function get($prefix, $key)
    {
        if(self::has($prefix, $key))
            return $_SESSION[$prefix][$key];
        echo self::errorSessionHandler($prefix, $key);
        return false;
    }
    public static function delete($prefix, $name)
    {
        if(self::has($prefix, $name)):
            unset($_SESSION[$prefix][$name]);
        endif;
    }
    public static function has($prefix, $key = null)
    {
        if(!empty($_SESSION))
            if(self::hasPrefix($prefix) && $key === null)
                return true;
            else if(self::hasPrefix($prefix) && self::hasName($prefix, $key))
                return true; 
        else 
            return false;
    }
    public static function hasPrefix($prefix)
    {
        if(isset($_SESSION[$prefix])):
            return true;
        endif;
        $_SESSION[$prefix] = Config::get('session/' . $prefix);        
        return false;
    }
    public static function hasName($prefix, $key)
    {
        if(isset($_SESSION[$prefix][$key]))
            return true;
        return false;
    }
    public static function errorSessionHandler($prefix, $name)
    {
        return 'Session : <b>' . $prefix . '</b> does not have name : <b>' . $name . '</b>';
    }
    public function destroy()
    {
        session_destroy();
    }
    // public function __destruct()
    // {
    //     $this->destroy();
    // }
}