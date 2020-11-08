<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

use Eightfold\Shoop\Foldable\Foldable;

interface Appendable
{
    public function append($value): Appendable;

    public function endsWith($value): Appendable;

    public function efEndsWith($value): bool;
}
