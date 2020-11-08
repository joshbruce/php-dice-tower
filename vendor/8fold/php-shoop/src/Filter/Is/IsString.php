<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

/**
 * @version 1.0.0
 */
class IsString extends Filter
{
    public function __invoke($using): bool
    {
        return is_string($using);
    }
}
