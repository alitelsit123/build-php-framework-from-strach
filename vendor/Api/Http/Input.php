<?php
namespace Api\Http;

class Input
{
    private $data;
    public function __construct()
    {
        if(sizeof($_POST) > 0)
        {
            $this->inputSelf();
        }
        else 
        {
            echo 'Tidak ada Inputan';
        }
    }   
    public function inputSelf()
    {
        $this->data = $_POST;
    }
    public function remove($key = null)
    {
        foreach($key as $element)
        {
            unset($this->data[$element]);
        }
    }
    public function toArray()
    {
        $this->data = array_values($this->data);
        return $this->data;
    }
    public function addFirst($value)
    {
        array_unshift($this->data, $value);
    }
    public function get($name)
    {
        return $this->data[$name];
    }
}