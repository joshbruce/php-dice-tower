<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

/**
 * @todo deprecate - ??
 */
class IsBoolean extends Filter
{
    public function __invoke($using): bool
    {
        return is_bool($using);
    }
}
