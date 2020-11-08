<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Members;
use Eightfold\Shoop\Filter\Traverse\RetainUsing;
use Eightfold\Shoop\Filter\Length;

/**
 * @todo deprecate - ??
 */
class IsDictionary extends Filter
{
    public function __invoke($using): bool
    {
        if (! IsList::apply()->unfoldUsing($using)) {
            return false;
        }

        $members       = Members::fromList($using);
        $stringMembers = RetainUsing::fromList($members, "is_string");
        $membersCount  = Length::fromList($stringMembers);
        if (IsIdenticalTo::fromNumber($membersCount, 0)) {
            return false;
        }

        $usingCount = Length::fromList($using);
        return IsIdenticalTo::fromNumber($usingCount, $membersCount);
    }
}
