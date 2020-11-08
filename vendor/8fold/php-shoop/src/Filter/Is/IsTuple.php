<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

use \stdClass;

use Eightfold\Shoop\Filter\Reversed;

use Eightfold\Shoop\Filter\Has\HasMethods;

use Eightfold\Shoop\Filter\Is\IsObject;
use Eightfold\Shoop\Filter\Is\IsJson;

/**
 * @version 1.0.0
 */
class IsTuple extends Filter
{
    public function __invoke($using): bool
    {
        if (is_a($using, stdClass::class)) {
            return true;
        }

        if (IsObject::applyWith(false)->unfoldUsing($using)) {
            $hasMethods = HasMethods::apply()->unfoldUsing($using);
            return Reversed::fromBoolean($hasMethods);
        }

        return IsJson::apply()->unfoldUsing($using);
    }
}
