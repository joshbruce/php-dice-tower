<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

interface Comparable
{
    public function is($compare): Falsifiable;

    public function isGreaterThan($compare): Falsifiable;

    public function isGreaterThanOrEqualTo($compare): Falsifiable;
}
