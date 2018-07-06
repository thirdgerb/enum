<?php

namespace Thirdgerb;

class Enum {

    private $name;

    private function __construct(string $name){
        $this->name = $name;
    }

    public function name()
    {
        return $this->name;
    }

    public function val()
    {
        return constant($this->constName());
    }

    public function equals($val)
    {
        return $this->val() === $val;
    }

    public function __toString()
    {
        return $this->constName();
    }

    public function constName()
    {
        return static::class . '::' . $this->name;
    }

    /**
     * @param string $name
     * @param array $args
     * @return static
     */
    public static function __callStatic($name, $args){
        if (!is_null(constant(static::class . '::' . $name))) {
            return new static($name);
        }
        throw new \InvalidArgumentException('const '.static::class . '::'.$name. ' not found ');
    }
}
