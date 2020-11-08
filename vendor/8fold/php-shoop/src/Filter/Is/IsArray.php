<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Members;
use Eightfold\Shoop\Filter\Length;
use Eightfold\Shoop\Filter\First;
use Eightfold\Shoop\Filter\Last;

use Eightfold\Shoop\Filter\Traverse\RetainUsing;

/**
 * @todo get type of first value and make sure all values in the array are of
 *       the same type - ??
 */
class IsArray extends Filter
{
    public function __invoke($using): bool
    {
        if (! IsList::apply()->unfoldUsing($using)) {
            return false;
        }

        if (IsDictionary::apply()->unfoldUsing($using)) {
            return false;
        }

        $members       = Members::fromList($using);
        $intMembers    = RetainUsing::fromList($members, "is_int");
        $membersCount  = Length::fromList($intMembers);
        if (IsIdenticalTo::fromNumber($membersCount, 0)) {
            return false;
        }

        $firstIndex = First::fromList($members);
        if (! IsIdenticalTo::fromNumber($firstIndex, 0)) {
            return false;
        }

        $lastIndex = Last::fromList($members);

        $range = range($firstIndex, $lastIndex);

        return IsIdenticalTo::fromList($members, $range);
    }
}
