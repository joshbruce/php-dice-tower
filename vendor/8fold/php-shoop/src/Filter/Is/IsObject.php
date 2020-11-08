<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Reversed;

use Eightfold\Shoop\Filter\Is\Not\IsNotTuple;

/**
 * @version 1.0.0
 *
 * @todo Remove constructor - use $this->main and document
 */
class IsObject extends Filter
{
    private $applyShoopRules = true;

    public function __construct($applyShoopRules = true)
    {
        $this->applyShoopRules = $applyShoopRules;
    }

    public function __invoke($using): bool
    {
        $doNotApplyShoopRules = Reversed::fromBoolean($this->applyShoopRules);
        if ($doNotApplyShoopRules) {
            return is_object($using);
        }

        $isObject = is_object($using);
        if (Reversed::fromBoolean($isObject)) {
            return false;
        }

        $isTuple = IsTuple::apply()->unfoldUsing($using);
        return Reversed::fromBoolean($isTuple);
    }
}
