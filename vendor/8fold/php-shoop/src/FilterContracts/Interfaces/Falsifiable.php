<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

use Eightfold\Foldable\Foldable;

interface Falsifiable
{
    public function asBoolean(): Falsifiable;

    public function efToBoolean(): bool;
}
