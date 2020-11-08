<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

interface Reversible
{
    public function reversed(): Reversible;
}
