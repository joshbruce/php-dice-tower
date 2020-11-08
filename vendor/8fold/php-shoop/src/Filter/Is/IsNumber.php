<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Reversed;

/**
 * @version 1.0.0
 */
class IsNumber extends Filter
{
    public function __invoke($using): bool
    {
        if (is_numeric($using)) {
            $isString = IsString::apply()->unfoldUsing($using);
            return Reversed::fromBoolean($isString);
        }
        return false;
    }
}
