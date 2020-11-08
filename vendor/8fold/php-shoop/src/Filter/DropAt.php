<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\Filter\TypeJuggling\AsArray;
use Eightfold\Shoop\Filter\TypeJuggling\AsDictionary;
use Eightfold\Shoop\Filter\TypeJuggling\AsString;
use Eightfold\Shoop\Filter\TypeJuggling\AsTuple;

/**
 * @todo invocation, type-specific methods
 */
class DropAt extends Filter
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
        // if (TypeIs::applyWith("boolean")->unfoldUsing($using)) {
        //     if (TypeIs::applyWith("integer")->unfoldUsing($this->main)) {
        //         return Shoop::pipe($using,
        //             TypeAsArray::apply(),
        //             MinusAt::applyWith($this->main),
        //             TypeAsArray::apply(),
        //             At::applyWith(0)
        //         )->unfold();

        //     }
        //     return Shoop::pipe($using,
        //         TypeAsDictionary::apply(),
        //         MinusAt::applyWith($this->main),
        //         TypeAsArray::apply(),
        //         At::applyWith(0)
        //     );

        // } elseif (TypeIs::applyWith("number")->unfoldUsing($using)) {
        //     return Minus::applyWith($this->main)->unfoldUsing($using);

        // } elseif (TypeIs::applyWith("list")->unfoldUsing($using)) {
        //     if (TypeIs::applyWith("array")->unfoldUsing($using)) {
        //         unset($using[$this->main]);
        //         return array_values($using);

        //     }
        //     unset($using[$this->main]);
        //     return $using;

        // } elseif (TypeIs::applyWith("string")->unfoldUsing($using)) {
        //     return Shoop::pipe($using,
        //         TypeAsArray::apply(),
        //         MinusAt::applyWith($this->main),
        //         TypeAsString::apply()
        //     )->unfold();

        // } elseif (TypeIs::applyWith("tuple")->unfoldUsing($using)) {
        //     return Shoop::pipe($using,
        //         TypeAsDictionary::apply(),
        //         MinusAt::applyWith($this->main),
        //         TypeAsTuple::apply()
        //     )->unfold();

        // } elseif (TypeIs::applyWith("object")->unfoldUsing($using)) {
        //     var_dump(__FILE__);
        //     die("object");

        // }
    }

    static public function fromString(string $using, int $index): string
    {
        $array = Divide::fromString($using);
        $array = static::fromList($array, $index);
        return AsString::fromList($array);
    }

    /**
     * @todo PHP 8 - , int|string
     *
     * @param  array  $using  [description]
     * @param  [type] $member [description]
     * @return [type]         [description]
     */
    static public function fromList(array $using, $member): array
    {
        unset($using[$member]);
        if (Is::integer()->unfoldUsing($member)) {
            return AsArray::fromList($using);
        }
        return $using;
    }

    static public function fromTuple($using, string $member): object
    {
        $dictionary = AsDictionary::fromTuple($using);
        $dictionary = static::fromList($dictionary, $member);
        return AsTuple::fromList($dictionary);
    }
}
