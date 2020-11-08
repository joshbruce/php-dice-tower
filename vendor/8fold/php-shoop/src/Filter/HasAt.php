<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Apply;

use Eightfold\Shoop\Filter\TypeJuggling\AsArray;
use Eightfold\Shoop\Filter\TypeJuggling\AsDictionary;

/**
 * @todo - rename HasMember
 *
 * Return whether a content or collection type `Has` one or more values `At` the specified location(s).
 *
 * If the `membersSearch` is a list of integers, an array representation is used.
 *
 * If the `membersSearch` is a list of strings, a dictionary representation is used.
 *
 * If the `membersSearch` is a mixed array, an array of strings is used, which means `At` maybe become empty; thereby returning false.
 *
 * If the `membersSearch` is a single value that value is placed in an array and used.
 *
 */
class HasAt extends Filter
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

    /**
     * @todo PHP 8 - int|float, int|float
     */
    static public function fromNumber($using, $needle): bool
    {
        return Has::fromNumber($using, $needle);
    }

    static public function fromString(string $using, int $index)
    {
        $array = Divide::fromString($using);
        return static::fromArray($array, $index);
    }

    static public function fromList(array $using, $member): bool
    {
        if (Is::string()->unfoldUsing($member)) {
            $dictionary = AsDictionary::fromList($using);
            return static::fromDictionary($dictionary, $member);
        }
        $array = AsArray::fromList($using);
        return static::fromArray($array, $member);
    }

    static public function fromDictionary(array $using, string $member): bool
    {
        $members = Members::fromList($using);
        return Has::fromList($members, $member);
    }

    static public function fromArray(array $using, int $member): bool
    {
        $members = Members::fromList($using);
        return Has::fromList($members, $member);
    }

    static public function fromTuple($using, string $member)
    {
        $dictionary = AsDictionary::fromTuple($using);
        return static::fromDictionary($dictionary, $member);
    }

    static public function fromJson(string $using, string $member)
    {
        $dictionary = AsDictionary::fromTuple($using);
        return static::fromDictionary($dictionary, $member);
    }
}
