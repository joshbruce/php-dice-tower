<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\TypeJuggling;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Members;
use Eightfold\Shoop\Filter\Reversed;
use Eightfold\Shoop\Filter\At;

use Eightfold\Shoop\Filter\Traverse\RetainUsing;
use Eightfold\Shoop\Filter\Traverse\EachUsing;

use Eightfold\Shoop\Filter\Is;
use Eightfold\Shoop\Filter\Is\IsJson;
use Eightfold\Shoop\Filter\Is\IsNumber;
use Eightfold\Shoop\Filter\Is\IsObject;

use Eightfold\Shoop\Filter\Implementing\IsTupleable;
use Eightfold\Shoop\Filter\Implementing\IsAssociable;

/**
 * @todo invocation - done ??
 */
class AsDictionary extends Filter
{
    public function __invoke($using): array
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

    static public function fromBoolean(bool $using): array
    {
        return ($using)
            ? ["false" => false, "true" => true]
            : ["false" => true, "true" => false];
    }

    // TODO: PHP 8 - int|float
    static public function fromNumber($using): array
    {
        $array = AsArray::fromNumber($using);
        return static::fromList($array);
    }

    static public function fromString(string $using): array
    {
        return ["content" => $using];
    }

    static public function fromList(array $using): array
    {
        $callable = function($value, $member, &$build) {
            // TODO: if member is not string, convert to string
            if (IsNumber::apply()->unfoldUsing($member)) {
                $member = AsString::fromNumber($member);
            }
            $build[$member] = $value;
        };

        return EachUsing::fromList($using, $callable);
    }

    // TODO: PHP 8 - string|object
    static public function fromTuple($using): array
    {
        if (IsTupleable::apply()->unfoldUsing($using)) {
            $using = $using->efToTuple();

        } elseif (IsJson::apply()->unfoldUsing($using)) {
            return static::fromJson($using);

        }

        $isObject = IsObject::applyWith(false)->unfoldUsing($using);
        if (Reversed::fromBoolean($isObject)) {
            return [];

        }

        $members = Members::fromObject($using);
        $props   = At::fromList($members, "properties");

        $callable = function($v, $m, &$build) {
            if ($v !== null and ! is_a($v, Closure::class)) {
                $build[$m] = $v;

            }
        };

        return RetainUsing::fromList($props, $callable);
    }

    static public function fromJson(string $using): array
    {
        $tuple = AsTuple::fromJson($using);
        return static::fromTuple($tuple);
    }

    static public function fromObject(object $using): array
    {
        if (IsAssociable::apply()->unfoldUsing($using)) {
            return $using->efToDictionary();
        }
        return static::fromTuple($using);
    }
}
