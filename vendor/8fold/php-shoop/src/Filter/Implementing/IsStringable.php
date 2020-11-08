<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Implementing;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\FilterContracts\Interfaces\Stringable;

/**
 * @version 1.0.0
 */
class IsStringable extends Filter
{
    public function __invoke($using): bool
    {
        return DoesImplement::applyWith(Stringable::class)->unfoldUsing($using);
    }
}
