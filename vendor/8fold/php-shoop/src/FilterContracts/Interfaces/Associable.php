<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

use \ArrayAccess;
use \Iterator;

use Eightfold\Shoop\FilterContracts\Interfaces\Associable;
use Eightfold\Shoop\FilterContracts\Interfaces\Addable;
use Eightfold\Shoop\FilterContracts\Interfaces\Subtractable;

interface Associable extends ArrayAccess, Iterator, Addable, Subtractable
{
    public function asDictionary(): Associable;

    public function efToDictionary(): array;

    public function has($member): Falsifiable;

    public function hasAt($member): Falsifiable;

    public function offsetExists($offset): bool; // ArrayAccess

    public function at($member);

    public function first($length = 1);

    public function last($length = 1);

    public function offsetGet($offset); // ArrayAccess

    // TODO: PHP 8.0 - mixed, string|int, bool|Falsifiable
    public function insertAt($value, $member = PHP_INT_MAX): Associable;

    public function offsetSet($offset, $value): void; // ArrayAccess

    public function dropAt($member);

    public function dropFirst($length = 1): Associable;

    public function dropLast($length = 1): Associable;

    public function offsetUnset($offset): void; // ArrayAcces

    public function each(callable $callable): Associable;

    public function retain(callable $callable): Associable;

    public function drop(callable $callable): Associable;

// - Iterator
    public function rewind(): void;

    public function valid(): bool;

    public function current();

    public function key();

    public function next(): void;
}
