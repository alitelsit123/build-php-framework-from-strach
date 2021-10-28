<?php
namespace Api\Http;

class Token
{
    public static function generate($prefix)
    {
        Session::set($prefix, $prefix . '_token', md5(uniqid()));
        return Session::get($prefix, $prefix . '_token');
    }
    public static function check($prefix, $token)
    {
        $name = $prefix . '_token';
        if($token === Session::get($prefix, $name)):
            Session::delete($prefix, $name);
            return true;
        endif;
        return false;
    }
}