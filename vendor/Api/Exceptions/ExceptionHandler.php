<?php
namespace Api\Exceptions;
class _404{}
class BadMethod{}
class BadVariable{}
class ExceptionHandler extends \Exception
{
    public static function _404()
    {
        return 'Uri Error';
    }
    public static function _sectionNotFound()
    {
        return 'Template Does not contains Yields';
    }
}