<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\TypeJuggling\AsString;

use Eightfold\Shoop\Filter\Is\IsIdenticalTo;

/**
 * @todo - invocation
 */
class Last extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            // if (Is::object()->unfoldUsing($using)) {
            //     return static::fromObject($using, $this->main);
            // }
            // return static::fromTuple($using, $this->main);

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using, $this->main);

        // } elseif (Is::number()->unfoldUsing($using)) {
        //     return static::fromNumber($using, $this->main);

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using, $this->main);

        } elseif (Is::string()->unfoldUsing($using)) {
            // if (Is::json()->unfoldUsing($using)) {
            //     return static::fromTuple($using, $this->main);
            // }
            return static::fromString($using, $this->main);
        }
    }

    static public function fromString(string $using, int $length = 1): string
    {
        $array = Divide::fromString($using);

        $last = static::fromList($array, $length);
        if (IsIdenticalTo::fromNumber($length, 1)) {
            return $last;
        }

        return AsString::fromList($last);
    }

    static public function fromList(array $using, int $length = 1)
    {
        $count = Length::fromList($using);

        $start = Minus::fromNumber($count, $length);
        $build = From::fromList($using, $start, $length);
        return (IsIdenticalTo::fromNumber($length, 1)) ? array_pop($build) : $build;
    }
}
