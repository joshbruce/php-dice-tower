<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\CountIsGreaterThan;

use Eightfold\Shoop\Filter\Length;
use Eightfold\Shoop\Filter\StartsWith;
use Eightfold\Shoop\Filter\EndsWith;

/**
 * @version 1.0.0
 */
class IsJson extends Filter
{
    public function __invoke($using): bool
    {
        if (IsString::apply()->unfoldUsing($using) and
            CountIsGreaterThan::fromString($using, 1) and
            StartsWith::fromString($using, "{") and
            EndsWith::fromString($using, "}") and
            IsObject::applyWith(false)->unfoldUsing(json_decode($using)) // using AsJson filter would cause overflow
        ) {
            $lastError     = json_last_error();
            $expectedError = JSON_ERROR_NONE;
            return IsIdenticalTo::fromNumber($lastError, $expectedError);
        }
        return false;
    }
}
