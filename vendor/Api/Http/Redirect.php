<?php
namespace Api\Http;
use Api\Config\Config;
class Redirect
{
    public static function back()
    {

    }
    public static function to($url)
    {
        $url = Config::get('url/base_url') . $url;
        header('Location: ' . $url, true, 301);
        exit();
    }
}