<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\Filter\MultipliedBy;

use Eightfold\Shoop\Filter\TypeJuggling\AsDictionary;
use Eightfold\Shoop\Filter\TypeJuggling\AsString;
use Eightfold\Shoop\Filter\TypeJuggling\AsTuple;


/**
 * @todo - invocation
 */
class Reversed extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            if (Is::object()->unfoldUsing($using)) {
                return static::fromObject($using, $this->main);
            }
            return static::fromTuple($using, $this->main);

        } elseif (Is::boolean()->unfoldUsing($using)) {
            return static::fromBoolean($using, $this->main);

        } elseif (Is::number()->unfoldUsing($using)) {
            return static::fromNumber($using, $this->main);

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using, $this->main);

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return static::fromTuple($using, $this->main);
            }
            return static::fromString($using, $this->main);
        }
    }

    static public function fromBoolean(bool $using): bool
    {
        return ! $using;
    }

    // TODO: PHP 8 - int|float -> int|float
    static public function fromNumber($using)
    {
        return MultipliedBy::fromNumber($using, -1);
    }

    static public function fromString(string $using): string
    {
        $array = Divide::fromString($using);
        $array = static::fromList($array);

        return AsString::fromList($array);
    }

    static public function fromList(array $array): array
    {
        return array_reverse($array);
    }

    static public function fromTuple($using): object
    {
        $dictionary = AsDictionary::fromTuple($using);
        $reversed   = static::fromList($dictionary);
        return AsTuple::fromList($reversed);
    }

    static public function fromJson(string $using): string
    {
        $dictionary = static::fromTuple($using);
        return AsJson::fromList($dictionary);
    }

    static public function fromObject(object $using): object
    {
        if (IsReversible::apply()->unfoldUsing($using)) {
            return $using->reversed();
        }
        return static::fromTuple($using);
    }
}
