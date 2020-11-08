<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\TypeJuggling;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Is;
use Eightfold\Shoop\Filter\Is\IsJson;

use Eightfold\Shoop\FilterContracts\Interfaces\Tupleable;

/**
 * @todo invocation - done ??
 */
class AsJson extends Filter
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

    static public function fromBoolean(bool $using): string
    {
        $tuple = AsTuple::fromBoolean($using);
        return static::fromTuple($tuple);
    }

    // TODO: PHP 8 - int|float
    static public function fromNumber($using): string
    {
        $tuple = AsTuple::fromNumber($using);
        return static::fromTuple($tuple);
    }

    static public function fromString(string $using): string
    {
        if (IsJson::apply()->unfoldUsing($using)) {
            return $using;
        }

        $tuple = AsTuple::fromString($using);
        return static::fromTuple($tuple);
    }

    static public function fromList(array $using): string
    {
        $tuple = AsTuple::fromList($using);
        return static::fromTuple($tuple);
    }

    static public function fromTuple($using): string
    {
        $tuple = AsTuple::fromTuple($using);
        return json_encode($tuple);
    }

    static public function fromJson(string $using): string
    {
        return static::fromString($using);
    }

    static public function fromObject(object $using): stdClass
    {
        $tuple = AsTuple::fromTuple($using);
        return static::fromTuple($using);
    }
}
