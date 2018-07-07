<?php

namespace Thirdgerb;

class Enum implements EnumInterface {

    private $name;

    /**
     * @var array
     */
    private static $constants = [];

    private function __construct(string $name){
        $this->name = $name;
    }

    final public static function names() : array
    {
        $class = static::class;
        if (array_key_exists($class, self::$constants)) {
            return array_keys(self::$constants[$class]);
        }

        $reflection = new \ReflectionClass(static::class);
        $constants = $reflection->getConstants();

        self::$constants[$class] = $constants ? : [];
        return array_keys($constants);
    }

    final public static function values() : array
    {
        static::names();
        return array_values(self::$constants[static::class]);
    }

    final public function name() : string
    {
        return $this->name;
    }

    final public function val()
    {
        return constant($this->constName());
    }

    final public function equals($val) : bool
    {
        return $this->val() === $val;
    }

    final public function __toString()
    {
        return $this->constName();
    }

    final public function constName() : string
    {
        return static::class . '::' . $this->name;
    }

    /**
     * @param string $name
     * @param array $args
     * @return static
     */
    final public static function __callStatic($name, $args){
        if (defined(static::class . '::' . $name)) {
            return new static($name);
        }
        throw new \InvalidArgumentException('constant '.static::class . '::'.$name. ' not found');
    }
}
