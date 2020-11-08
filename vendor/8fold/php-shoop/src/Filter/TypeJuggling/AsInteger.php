<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\TypeJuggling;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Is;

use Eightfold\Shoop\Filter\Implementing\IsCountable;

/**
 * @todo invocation - done ??
 */
class AsInteger extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            if (Is::object()->unfoldUsing($using)) {
                return static::fromObject($using);
            }
            return static::fromTuple($using);

        } elseif (Is::boolean()->unfoldUsing($using)) {
            return static::fromBoolean($using);

        } elseif (Is::number()->unfoldUsing($using)) {
            return static::fromNumber($using);

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using);

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return static::fromJson($using);
            }
            return static::fromString($using);
        }
    }

    static public function fromBoolean(bool $using): int
    {
        return (int) $using;
    }

    // TODO: PHP 8 - int|float
    static public function fromNumber($using): int
    {
        return (int) round($using); // TODO: Round filter
    }

    /**
     * If the string starts with a letter, 0 will be returned.
     *
     * If the string starts with a number, any characters following a numeric sequence are dropped. ex. 30he77o outputs 30
     */
    static public function fromString(string $using): int
    {
        return (int) $using;
    }

    static public function fromList(array $using): int
    {
        return (int) $using;
    }

    static public function fromTuple($using): int
    {
        $dictionary = AsDictionary::fromTuple($using);
        return static::fromList($dictionary);
    }

    static public function fromJson(string $using): int
    {
        return static::fromTuple($using);
    }

    static public function fromObject(object $using): int
    {
        if (IsCountable::apply()->unfoldUsing($using)) {
            return $using->efToInteger();
        }
        return static::fromTuple($using);
    }
}
