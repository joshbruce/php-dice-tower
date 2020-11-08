<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

/**
 * @version 1.0.0
 */
class IsInteger extends Filter
{
    public function __invoke($using): bool
    {
        if (IsNumber::apply()->unfoldUsing($using)) {
            if (is_integer($using)) {
                return true;
            }

            $floor = floor($using);
            return IsIdenticalTo::fromNumber($using, $floor);
        }
        return false;
    }
}
