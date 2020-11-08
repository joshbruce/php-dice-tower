<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Implementing;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\FilterContracts\Interfaces\Falsifiable;

/**
 * @version 1.0.0
 */
class IsFalsifiable extends Filter
{
    public function __invoke($using): bool
    {
        return DoesImplement::applyWith(Falsifiable::class)->unfoldUsing($using);
    }
}
