<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

use \JsonSerializable;

interface Tupleable extends JsonSerializable
{
    public function asTuple(): Tupleable;

    // PHP 8.0 - stdClass|object
    public function efToTuple(): object;

    public function asJson(): Tupleable;

    public function efToJson(): string;

    public function jsonSerialize(): object; // JsonSerializable
}
