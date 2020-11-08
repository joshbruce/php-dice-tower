<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Is\IsIdenticalTo;

use Eightfold\Shoop\Filter\TypeJuggling\AsString;

/**
 * @version 1.0.0
 */
class First extends Filter
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

        $first = static::fromList($array, $length);
        if (IsIdenticalTo::fromNumber($length, 1)) {
            return $first;
        }

        return AsString::fromList($first);
    }

    static public function fromList(array $using, int $length = 1)
    {
        $build = From::fromList($using, 0, $length);
        return (IsIdenticalTo::fromNumber($length, 1)) ? $build[0] : $build;
    }
}
