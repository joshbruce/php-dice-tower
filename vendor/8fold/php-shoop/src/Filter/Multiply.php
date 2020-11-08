<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

/**
 * @todo - invocation, create new Duplicate filter
 */
class Multiply extends Filter
{
    public function __invoke($using)
    {
    }

    // TODO: PHP 8 - int|float, int|float -> int|float
    static public function fromNumber($using, $multiplier)
    {
        return $using * $multiplier;
    }

    static public function fromString(string $using, int $length = 1): string
    {
    }

    static public function fromList(array $using)
    {
    }
}
