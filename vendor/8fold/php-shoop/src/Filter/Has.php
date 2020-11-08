<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\Filter\TypeJuggling\AsDictionary;

use Eightfold\Shoop\Filter\Is;
use Eightfold\Shoop\Filter\Is\IsIdenticalTo;
use Eightfold\Shoop\Filter\Is\IsGreaterThan;

/**
 * @todo invocation, implement __callStatic to reach HasMethods: Has::methods()->unfoldUsing($using)
 *
 * Return whether a given sequence `Has` a given value.
 *
 * All non-list types are converted to their `array` representation.
 *
 * Strings use a case-sensitive comparison and strict type comparison.
 *
 * PHP Standard Library: `in_array`
 */
class Has extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            if (Is::object()->unfoldUsing($using)) {
                return static::fromObject($using);
            }
            return static::fromTuple($using, ...$this->args(true));

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using);

        } elseif (Is::number()->unfoldUsing($using)) {
            return static::fromNumber($using, ...$this->args(true));

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using, ...$this->args(true));

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return static::fromJson($using, ...$this->args(true));
            }
            return static::fromString($using, ...$this->args(true));
        }
    }

    // TODO: PHP 8 - int|float, int|float
    static public function fromNumber($using, $compare): bool
    {
        if (IsIdenticalTo::fromNumber($using, $compare)) {
            return true;

        } elseif (IsGreaterThan::fromNumber($using, $compare)) {
            return true;

        }
        return false;
    }

    static public function fromString(string $using, string $needle): bool
    {
        return strpos($using, $needle) !== false;
    }

    // TODO: PHP 8 - , mixed
    static public function fromList(array $using, $needle): bool
    {
        return in_array($needle, $using, true);
    }

    static public function fromTuple($using, $needle): bool
    {
        $dictionary = AsDictionary::fromTuple($using);
        return static::fromList($dictionary, $needle);
    }

    static public function fromJson(string $using, $needle): bool
    {
        $dictionary = AsDictionary::fromJson($using);
        var_dump($dictionary);
        die(var_dump(
            static::fromList($dictionary, $needle)
        ));
        return static::fromTuple($tuple, $needle);
    }
}
