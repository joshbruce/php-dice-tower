<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

use Eightfold\Shoop\Foldable\Foldable;

interface Divisible
{
    public function divide(
        $divisor,
        $includeEmpties = true,
        $limit = PHP_INT_MAX
    ): Divisible;
}
