<?php

/**
 * Class EnumInterface
 * @package Thirdgerb
 */

namespace Thirdgerb;


interface EnumInterface
{

    public function name() : string;

    public function val();

    public function constName() : string;

    public function equals($val) : bool;

    public static function names(): array;

    public static function values() : array;

    public static function defined(string $name) : bool;

}