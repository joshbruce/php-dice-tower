<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

interface Emptiable
{
    public function isEmpty(): Emptiable;

    public function efIsEmpty(): bool;
}
