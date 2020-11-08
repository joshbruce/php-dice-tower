<?php

namespace Eightfold\Foldable;

use Eightfold\Foldable\Foldable;

interface Filterable
{
    static public function apply();

    static public function applyWith(...$args);

    public function unfoldUsing($payload);
}
