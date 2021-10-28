<?php
namespace Api\Http;
use Api\Routing\Router;

class Response
{
    public $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function send()
    {
        Router::getClass()->request($this->request);
        Router::getClass()->runAction();
    }
}