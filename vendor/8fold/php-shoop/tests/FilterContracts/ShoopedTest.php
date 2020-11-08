<?php

namespace Eightfold\Shoop\Tests\FilterContracts;

use Eightfold\Shoop\Tests\FilterContractsTestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Arrayable;
use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Associable;
use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Countable;
use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Stringable;
use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Tupleable;
use Eightfold\Shoop\Tests\FilterContracts\ContractTests\TypeCheckable;

use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Addable;
use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Divisible;
use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Subtractable;

use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Appendable;
use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Prependable;

use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Falsifiable;
use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Emptiable;
use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Comparable;
use Eightfold\Shoop\Tests\FilterContracts\ContractTests\Reversible;

use Eightfold\Shoop\Shooped;

/**
 * @group Shooped
 */
class ShoopedTest extends FilterContractsTestCase
{
    use Arrayable, Associable, Countable, Stringable, Tupleable, TypeCheckable, Emptiable,
        Falsifiable, Comparable, Reversible, Addable, Subtractable, Divisible, Appendable,
        Prependable;

    static public function sutClassName(): string
    {
        return Shooped::class;
    }
}
