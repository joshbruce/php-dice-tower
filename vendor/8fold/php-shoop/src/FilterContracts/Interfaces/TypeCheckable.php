<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

use Eightfold\Shoop\Foldable\Foldable;

interface TypeCheckable
{
    public function isArray(): TypeCheckable;

    public function efIsArray(): bool;

    public function isBoolean(): TypeCheckable;

    public function efIsBoolean(): bool;

    public function isDictionary(): TypeCheckable;

    public function efIsDictionary(): bool;

    public function isNumber(): TypeCheckable;

    public function efIsNumber(): bool;

    public function isInteger(): TypeCheckable;

    public function efIsInteger(): bool;

    public function isJson(): TypeCheckable;

    public function efIsJson(): bool;

    public function isString(): TypeCheckable;

    public function efIsString(): bool;

    public function isTuple(): TypeCheckable;

    public function efIsTuple(): bool;
}
