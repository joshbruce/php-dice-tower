<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Foldable;
use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Apply;

use Eightfold\Shoop\Filter\Is\IsList;

use Eightfold\Shoop\Filter\Traverse\RetainUsing;

/**
 * @version 1.0.0
 */
class Plus extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            // if (Is::object()->unfoldUsing($using)) {
            //     return static::fromObject($using);
            // }
            // return static::fromTuple($using, $this->main);

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using);

        } elseif (Is::number()->unfoldUsing($using)) {
            return static::fromNumber($using, ...$this->args(true));

        // } elseif (Is::list()->unfoldUsing($using)) {
        //     return static::fromList($using, $this->main);

        // } elseif (Is::string()->unfoldUsing($using)) {
        //     if (Is::json()->unfoldUsing($using)) {
        //         return static::fromTuple($using, $this->main);
        //     }
        //     return static::fromString($using, $this->main);

        }
    }

    // TODO: PHP 8 - int|float -> int|float
    static public function fromNumber($using, ...$addends)
    {
        $addends = RetainUsing::fromList($addends, "is_int");
        if (IsList::apply()->unfoldUsing($using)) {
            $allNumbers = Append::fromList($using, $addends);

        } else {
            $using      = Apply::asArray()->unfoldUsing($using);
            $allNumbers = Append::fromList($using, $addends);

        }

        return array_sum($allNumbers);
    }
}
