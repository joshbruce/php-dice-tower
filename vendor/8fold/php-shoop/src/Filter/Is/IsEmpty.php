<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Is;

use Eightfold\Shoop\Filter\TypeJuggling\AsDictionary;
use Eightfold\Shoop\Filter\TypeJuggling\AsTuple;

use Eightfold\Shoop\Filter\Implementing\IsEmptiable;

/**
 * @todo invocation
 */
class IsEmpty extends Filter
{
    public function __invoke($using): bool
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

    static public function fromBoolean(bool $using): bool
    {
        return empty($using);
    }

    // TODO: PHP 8 - int|float
    static public function fromNumber($using): bool
    {
        return empty($using);
    }

    static public function fromString(string $using): bool
    {
        return empty($using);
    }

    static public function fromList(array $using): bool
    {
        return empty($using);
    }

    // TODO: PHP 8 - object|string
    static public function fromTuple($using): bool
    {
        $dictionary = AsDictionary::fromTuple($using);
        return static::fromList($dictionary);
    }

    static public function fromJson(string $using): bool
    {
        return static::fromTuple($using);
    }

    static public function fromObject(object $using): bool
    {
        if (IsEmptiable::apply()->unfoldUsing($using)) {
            return $using->efIsEmpty();
        }

        $tuple = AsTuple::fromObject($using);
        return static::fromTuple($using);
    }
}
