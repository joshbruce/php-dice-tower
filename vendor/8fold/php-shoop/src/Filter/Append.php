<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Foldable;
use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Apply;

use Eightfold\Shoop\Filter\TypeJuggling\AsArray;
use Eightfold\Shoop\Filter\TypeJuggling\AsDictionary;
use Eightfold\Shoop\Filter\TypeJuggling\AsString;
use Eightfold\Shoop\Filter\TypeJuggling\AsTuple;

/**
 * @todo Test - rename PlusAt to InsertAt with default of PHP_MAX_INT, invocation; call from here
 */
class Append extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            if (Is::object()->unfoldUsing($using)) {
                return static::fromObject($using);
            }
            $dictionary = AsDictionary::apply()->unfoldUsing($this->main);
            return static::fromTuple($using, $dictionary);

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using);

        } elseif (Is::number()->unfoldUsing($using)) {
            return static::fromNumber($using, ...$this->args(true));

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using, $this->main);

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return static::fromJson($using);
            }
            $suffix = AsString::fromList($this->args(true));
            return static::fromString($using, $suffix);
        }
    }

    // TODO: PHP 8 - int|float, int|float -> int|float
    static public function fromNumber($using, $addend)
    {
        return Plus::fromNumber($using, $addend);
    }

    static public function fromString(
        string $using,
        string $characters = ""
    ): string
    {
        return $using . $characters;
    }

    /**
     * @todo PHP 8 - , mixed variadic
     *
     * if count is 1 and array - use array merge
     * otherwise, append using[] = suffix
     */
    static public function fromList(array $using, array $suffix): array
    {
        return array_merge($using, $suffix);
    }

    static public function fromTuple($using, array $suffix): object
    {
        $dictionary = AsDictionary::fromTuple($using);
        $dictionary = static::fromList($dictionary, $suffix);
        return AsTuple::fromList($dictionary);
    }
}
