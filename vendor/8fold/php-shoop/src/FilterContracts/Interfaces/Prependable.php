<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

use Eightfold\Shoop\Foldable\Foldable;

interface Prependable
{
    public function prepend($value): Prependable;

    public function startsWith($value): Prependable;

    public function efEndsWith($value): bool;
}
