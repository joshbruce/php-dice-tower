<?php

namespace Eightfold\Shoop\FilterContracts;

use Eightfold\Foldable\Foldable;

use Eightfold\Shoop\FilterContracts\Interfaces\Arrayable; // + Associable
use Eightfold\Shoop\FilterContracts\Interfaces\Appendable;
use Eightfold\Shoop\FilterContracts\Interfaces\Comparable;
use Eightfold\Shoop\FilterContracts\Interfaces\Countable;
use Eightfold\Shoop\FilterContracts\Interfaces\Divisible;
use Eightfold\Shoop\FilterContracts\Interfaces\Emptiable;
use Eightfold\Shoop\FilterContracts\Interfaces\Falsifiable;
use Eightfold\Shoop\FilterContracts\Interfaces\Prependable;
use Eightfold\Shoop\FilterContracts\Interfaces\Reversible;
use Eightfold\Shoop\FilterContracts\Interfaces\Stringable;
use Eightfold\Shoop\FilterContracts\Interfaces\Tupleable;
use Eightfold\Shoop\FilterContracts\Interfaces\TypeCheckable;

interface Shooped extends
    Foldable,
    Arrayable,
    Appendable,
    Comparable,
    Countable,
    Divisible,
    Emptiable,
    Falsifiable,
    Prependable,
    Reversible,
    Stringable,
    Tupleable,
    TypeCheckable
{
    public function __construct($main);
}
