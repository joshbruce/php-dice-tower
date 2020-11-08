<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

use \Countable as PhpCountable;

use Eightfold\Shoop\FilterContracts\Interfaces\Countable;

interface Countable extends PhpCountable
{
    public function asInteger(): Countable;

    public function efToInteger(): int;

    public function length(): Countable;

    public function count(): int; // Countable
}
