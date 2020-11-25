<?php
namespace cn\hofan\Models\Transits;


class Transit
{
    public const METHOD_CREATE_ORDER = "CREATE_ORDER";

    public $command;
    public $data = [];

    public function __get($name)
    {
        if(!isset($this->data[$name]))
            return null;

        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
}
