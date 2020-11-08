<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Implementing;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\FilterContracts\Interfaces\Arrayable;

/**
 * @version 1.0.0
 */
class IsArrayable extends Filter
{
    public function __invoke($using): bool
    {
        return DoesImplement::applyWith(Arrayable::class)->unfoldUsing($using);
    }
}
