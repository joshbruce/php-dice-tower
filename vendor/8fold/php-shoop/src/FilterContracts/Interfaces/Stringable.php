<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

// PHP 8.0 - use \Stringable as PhpStringable;

interface Stringable // extends PhpStringable
{
    public function asString(string $glue = ""): Stringable;

    public function efToString(string $glue = ""): string;

    public function __toString(): string;
}
