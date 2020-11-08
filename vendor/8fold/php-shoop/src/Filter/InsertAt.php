<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Foldable\Foldable;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Apply;

use Eightfold\Shoop\Filter\Append;
use Eightfold\Shoop\Filter\Prepend;

use Eightfold\Shoop\Filter\Is\IsIdenticalTo;
use Eightfold\Shoop\Filter\Is\IsList;

use Eightfold\Shoop\Filter\TypeJuggling\AsArray;
use Eightfold\Shoop\Filter\TypeJuggling\AsDictionary;
use Eightfold\Shoop\Filter\TypeJuggling\AsString;
use Eightfold\Shoop\Filter\TypeJuggling\AsTuple;

/**
 * @todo rename InsertAt, default is append w/ PHP_INT_MAX, -1 allowed to signal prepend
 * (argument for arrays starting at 1, as we could say insertAt(0) instead of insertAt(-1));
 * invocation
 *
 *
 */
class InsertAt extends Filter
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

        // } elseif (Is::number()->unfoldUsing($using)) {
        //     return static::fromNumber($using, ...$this->args(true));

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using, ...$this->args(true));

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return static::fromTuple($using, ...$this->args(true));
            }
            return static::fromString($using, ...$this->args(true));
        }
    }

    static public function fromString(
        string $using,
        string $value,
        int $member = PHP_INT_MAX
    ): string
    {
        $array = Divide::fromString($using);
        $array = static::fromList($array, $value, $member);
        return AsString::fromList($array);
    }

    /**
     * @todo PHP 8 - , mixed, int|string
     *
     * @param  array  $using [description]
     * @param  [type] $value [description]
     * @param  [type] $index [description]
     * @return [type]        [description]
     */
    static public function fromList(
        array $using,
        $value,
        $member = PHP_INT_MAX
    ): array
    {
        if (Is::number()->unfoldUsing($member)) {
            $isList = IsList::apply()->unfoldUsing($value);
            $isNotList = Reversed::fromBoolean($isList);
            if ($isNotList) {
                $value = AsArray::apply()->unfoldUsing($value);
            }

            if (IsIdenticalTo::applyWith(PHP_INT_MAX)->unfoldUsing($member)) {
                return Append::fromList($using, $value);

            } elseif (IsIdenticalTo::applyWith(-1)->unfoldUsing($member)) {
                return Prepend::fromList($using, $value);

            } else {
                $value = First::fromList($value);

            }
        }
        $using[$member] = $value;
        return $using;
    }

    static public function fromTuple($using, $value, string $member)
    {
        $dictionary = AsDictionary::fromTuple($using);
        $dictionary = static::fromList($dictionary, $value, $member);
        return AsTuple::fromList($dictionary);
    }
}
