<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Traverse;

use Eightfold\Foldable\Filter;

use \ReflectionFunction;

use Eightfold\Shoop\Filter\Length;
use Eightfold\Shoop\Filter\Divide;
use Eightfold\Shoop\Filter\Is;
use Eightfold\Shoop\Filter\Reversed;

use Eightfold\Shoop\Filter\TypeJuggling\AsArray;
use Eightfold\Shoop\Filter\TypeJuggling\AsString;

use Eightfold\Shoop\Filter\Is\IsIdenticalTo;

/**
 * @todo - invocation
 */
class DropUsing extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            if (Is::object()->unfoldUsing($using)) {
                return static::fromObject($using, ...$this->args(true));
            }
            return static::fromTuple($using, ...$this->args(true));

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using);

        // } elseif (Is::number()->unfoldUsing($using)) {
        //     return static::fromNumber($using, ...$this->args(true));

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using, ...$this->args(true));

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return static::fromJson($using, ...$this->args(true));
            }
            return static::fromString($using, ...$this->args(true));
        }
    }

    static public function fromString(string $using, callable $callable): string
    {
        $array = Divide::fromString($using);
        $array = static::fromList($array, $callable);
        return AsString::fromList($array);
    }

    static public function fromList(
        array $using,
        callable $callable
    ): array
    {
        $reflect = new ReflectionFunction($callable);
        $params  = $reflect->getParameters();
        $count   = Length::fromList($params);
        $build   = [];
        if (IsIdenticalTo::fromNumber($count, 1)) {
            foreach ($using as $v) {
                if (Reversed::fromBoolean($callable($v))) {
                    $build[] = $v;

                }
            }

        } elseif (IsIdenticalTo::fromNumber($count, 2)) {
            foreach ($using as $m => $v) {
                if (Reversed::fromBoolean($callable($v, $m))) {
                    $build[$m] = $v;

                }
            }

        } else {
            return EachUsing::fromList($using, $callable);

        }
        return $build;
    }
}
