<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\TypeJuggling\AsInteger;

/**
 * @todo - rename Length
 */
class Length extends Filter
{
    public function __invoke($using): int
    {
        if (Is::object(false)->unfoldUsing($using)) {
            // if (Is::object()->unfoldUsing($using)) {
            //     return static::fromObject($using);
            // }
            // $dictionary = AsDictionary::apply()->unfoldUsing($this->main);
            // return static::fromTuple($using, $dictionary);

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using);

        } elseif (Is::number()->unfoldUsing($using)) {
            return static::fromNumber($using);

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using);

        } elseif (Is::string()->unfoldUsing($using)) {
            // if (Is::json()->unfoldUsing($using)) {
            //     return static::fromJson($using);
            // }
            return static::fromString($using);
        }
    }

    /**
     * @todo PHP 8 - int|float
     */
    static public function fromNumber($using): int
    {
        return AsInteger::fromNumber($using);
    }

    static public function fromString(string $using): int
    {
        $array = Divide::fromString($using);
        return static::fromList($array);
    }

    static public function fromList(array $using): int
    {
        return count($using);
    }
}
