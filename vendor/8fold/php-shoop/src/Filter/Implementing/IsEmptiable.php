<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Implementing;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\FilterContracts\Interfaces\Emptiable;

/**
 * @version 1.0.0
 */
class IsEmptiable extends Filter
{
    public function __invoke($using): bool
    {
        return DoesImplement::applyWith(Emptiable::class)->unfoldUsing($using);
    }
}
