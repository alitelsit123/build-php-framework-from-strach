<?php
namespace Api\View;
use Api\Support\Grammar;
class View
{
    public static function view($file, $datas = null)
    {
        // echo $file;
        $stringFile = self::getString($file, $datas);
        $pathTemplate = Grammar::getPathTemplate($stringFile) === false ? $file:Grammar::getPathTemplate($stringFile);
        $stringTemplate = self::getString($pathTemplate);
        $result = Grammar::replaceYield($stringTemplate, $stringFile);
        // var_dump($stringFile);
        return $result;
    }
    public static function getString($file, $datas = null)
    {
        if($datas !== null):
            foreach($datas as $key => $val):
                ${$key} = $val;
            endforeach;
        endif;
        ob_start();
            include '../resources/' . $file . '.php';
        $file = ob_get_clean();
        return $file;
    }
}