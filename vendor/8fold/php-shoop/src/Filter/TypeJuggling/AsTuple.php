<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\TypeJuggling;

use Eightfold\Foldable\Filter;

use \stdClass;

use Eightfold\Shoop\Filter\Type;
use Eightfold\Shoop\Filter\Is;

use Eightfold\Shoop\Filter\Is\IsJson;

use Eightfold\Shoop\Filter\Implementing\IsTupleable;

/**
 * @todo invocation - done ??
 */
class AsTuple extends Filter
{
    public function __invoke($using): stdClass
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

    static public function fromBoolean(bool $using): stdClass
    {
        $dictionary = AsDictionary::fromBoolean($using);
        return static::fromList($dictionary);
    }

    // TODO: PHP 8.0 - int|float
    static public function fromNumber($using): stdClass
    {
        $dictionary = AsDictionary::fromNumber($using);
        return static::fromList($dictionary);
    }

    static public function fromString(string $using): stdClass
    {
        $dictionary = AsDictionary::fromString($using);
        return static::fromList($dictionary);
    }

    static public function fromList(array $using): stdClass
    {
        $dictionary = AsDictionary::fromList($using);
        return (object) $dictionary;
    }

    // TODO: PHP 8 - string|object
    static public function fromTuple($using): stdClass
    {
        $dictionary = AsDictionary::fromTuple($using);
        return (object) $dictionary;
    }

    static public function fromJson(string $using): stdClass
    {
        if (IsJson::apply()->unfoldUsing($using)) {
            $tuple = json_decode($using);
            return static::fromTuple($tuple);
        }
        return static::fromString($using);
    }

    static public function fromObject(object $using): stdClass
    {
        if (IsTupleable::apply()->unfoldUsing($using)) {
            return $using->efToTuple();
        }
        return static::fromTuple($using);
    }
}
