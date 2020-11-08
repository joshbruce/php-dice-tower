<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;

/**
 * @todo - invocation
 */
class MultipliedBy extends Filter
{
    public function __invoke($using)
    {
    }

    // TODO: PHP 8 - int|float, int|float -> int|float
    static public function fromNumber($using, $multiplicand)
    {
        return $using * $multiplicand;
    }
}
