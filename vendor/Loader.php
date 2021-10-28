<?php
class Loader
{
    public static function load()
    {
        spl_autoload_register(function($class){
            $class = ltrim($class, '\\');
            $nameSpace = '';
            $fileName = '';
            if($fileNamePos = strrpos($class, '\\')):
                $nameSpace = substr($class, 0, $fileNamePos);
                $class = substr($class, $fileNamePos + 1);
                $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $nameSpace) . DIRECTORY_SEPARATOR;
            endif;
            $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $class); 
            require_once $fileName . '.php'; 
        });
    }
}
Loader::load();