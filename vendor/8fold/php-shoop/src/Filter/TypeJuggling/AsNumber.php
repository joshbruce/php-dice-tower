<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\TypeJuggling;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Has;
use Eightfold\Shoop\Filter\Type;

use Eightfold\Shoop\Filter\Is\IsInteger;

/**
 * @todo invocation
 */
class AsNumber extends Filter
{
    public function __invoke($using)
    {
    }

    // TODO: PHP 8 -> int
    static public function fromBoolean(bool $using): int
    {
        return AsInteger::fromBoolean($using);
    }

    // TODO: PHP 8 - int|float -> int|float
    static public function fromNumber($using)
    {
        if (IsInteger::apply()->unfoldUsing($using)) {
            return AsInteger::fromNumber($using);
        }
        return (float) $using;
    }

    // TODO: PHP 8 -> int|float
    /**
     * If the string starts with a letter, 0 will be returned.
     *
     * If the string starts with a number, any characters following a numeric sequence are dropped. ex. 30he77o outputs (int) 30
     *
     * If the string starts with a number and contains a period, a floating point number is returned, which may be an integer. ex. 30h.e77o outputs (float) 30.0
     */
    static public function fromString(string $using)
    {
        if (Has::fromString($using, ".")) {
            return (float) $using;
        }
        return AsInteger::fromString($using);
    }

    static public function fromList(array $using): int
    {
        return AsInteger::fromList($using);
    }

    static public function fromTuple($using): int
    {
        return AsInteger::fromTuple($using);
    }

    static public function fromJson(string $using): int
    {
        return AsInteger::fromJson($using);
    }

    static public function fromObject(object $using): int
    {
        return AsInteger::fromObject($using);
    }
}
