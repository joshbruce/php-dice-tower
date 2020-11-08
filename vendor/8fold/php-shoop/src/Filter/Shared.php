<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Apply;

/**
 * @todo - deprecate - ??
 */
class Shared extends Filter
{
    public function __invoke($using)
    {
        // if (TypeIs::applyWith("sequential")->unfoldUsing($using) or
        //     TypeIs::applyWith("boolean")->unfoldUsing($using)
        // ) {
        //     $using = Apply::typeAsArray()->unfoldUsing($using);
        //     $this->comparing = Apply::typeAsArray()
        //         ->unfoldUsing($this->comparing);

        //     $result = array_intersect($using, $this->comparing);
        //     return Apply::typeAsArray()->unfoldUsing($result);
        // }

        // $using = Apply::typeAsDictionary()->unfoldUsing($using);
        // $this->comparing = Apply::typeAsDictionary()
        //     ->unfoldUsing($this->comparing);

        // $build = [];
        // foreach ($this->comparing as $value) {
        //     $member = array_search($value, $using);
        //     if ($member !== null) {
        //         $build[$member] = $using[$member];
        //     }
        // }
        // return $build;
    }
}
