<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Is;

/**
 * @group invocation
 *
 * @todo IsIdenticalTo and invocation
 */
class IsIdenticalTo extends Filter
{
    public function __invoke($using): bool
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

    static public function fromBoolean(bool $using, $comparison): bool
    {
        return $using === $comparison;
    }

    // TODO: PHP 8.0 int|float, int|float
    static public function fromNumber($using, $comparison): bool
    {
        return $using === $comparison;
    }

    static public function fromString(string $using, $comparison): bool
    {
        return $using === $comparison;
    }

    static public function fromList(array $using, $comparison): bool
    {
        return $using === $comparison;
    }

    static public function fromTuple($using, $comparison): bool
    {
        return $using === $comparison;
    }
}
