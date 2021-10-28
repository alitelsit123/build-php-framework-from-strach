<?php
namespace Api\Http;
use Api\Config\Config;
use Api\Support\Converter;

class Request
{
    public function __construct()
    {
        $this->registers();
    }
    public function registers()
    {
        foreach($_SERVER as $key => $val)
        {
            $this->{Converter::toCamelCase($key, '_')} = $val;
        }
    }
    public function formattedRequestMethod()
    {
        $requestMethod = strtoupper($this->requestMethod);
        return $requestMethod;
    }
    public function formattedRequestUri()
    {
        $base = Config::get('url/base_url');
        $uri = str_replace($base, '', rtrim($this->requestUri, '/'));
        if($uri === ''):
            echo $uri;            
            return '/';
        endif;
        return $uri;
    }
    public static function capture()
    {
        return new Request();
    }
}