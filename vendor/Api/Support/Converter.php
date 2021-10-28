<?php
namespace Api\Support;

class Converter
{
    public static function toCamelCase($string, $delimiter)
    {
        $result = strtolower($string);
        preg_match_all('/' . $delimiter . '[a-z]/', $result, $matches);
        foreach($matches[0] as $match)
        {
            $removeDelmtr = str_replace($delimiter, '',strtoupper($match));
            $result = str_replace($match, $removeDelmtr, $result);
        }
       
        return $result;
    }
    public static function frontGrammar($stringBefore, $string)
    {
        $result = $stringBefore;
        preg_replace('{{{' . '[a-zA-z0-9]+' . '}}}', $string, $result);
        return $result;
    }
    public static function queryUrl($key)
    {
        preg_match_all('/\{[a-z]+\}/', $key, $params);
        return $params[0]; 
    }
}