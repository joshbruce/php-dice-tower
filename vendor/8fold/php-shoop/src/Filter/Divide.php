<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\Filter\Is\IsIdenticalTo;

use Eightfold\Shoop\Filter\Traverse\DropUsing;

/**
 * @todo - invocation, rename to DivideBy
 */
class Divide extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            // if (Is::object()->unfoldUsing($using)) {
            //     return static::fromObject($using, $this->main);
            // }
            // return static::fromTuple($using, $this->main);

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using, $this->main);

        } elseif (Is::number()->unfoldUsing($using)) {
            return static::fromNumber($using, $this->main);

        // } elseif (Is::list()->unfoldUsing($using)) {
        //     return static::fromList($using, $this->main);

        } elseif (Is::string()->unfoldUsing($using)) {
            // if (Is::json()->unfoldUsing($using)) {
            //     return static::fromTuple($using, $this->main);
            // }
            return static::fromString($using, ...$this->args(true));
        }
    }

    /**
     * true, true  : back and front
     * true, false : front only
     * false, true : back only
     * false, false: all occurrences
     *
     * TODO: PHP 8 - string, bool, bool, array|int
     */
    static public function fromString(
        string $using,
        string $divisor      = "",
        bool $includeEmpties = true,
        int $limit           = PHP_INT_MAX
    ): array
    {
        if (IsIdenticalTo::fromString($divisor, "")) {
            return mb_str_split($using);
        }

        $base = explode($divisor, $using, $limit);
        if ($includeEmpties) {
            return $base;
        }
        return DropUsing::fromList($base, function($v) { return empty($v); });
    }

    // TODO: PHP 8 - int|float, int|float -> int|float
    static public function fromNumber($using, $divisor)
    {
        return $using/$divisor;
    }
}
