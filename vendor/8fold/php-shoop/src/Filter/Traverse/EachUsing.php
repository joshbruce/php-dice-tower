<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Traverse;

use Eightfold\Foldable\Foldable;
use Eightfold\Foldable\Filter;

use \ReflectionFunction;

use Eightfold\Shoop\Filter\Length;
use Eightfold\Shoop\Filter\Divide;
use Eightfold\Shoop\Filter\Is;

use Eightfold\Shoop\Filter\TypeJuggling\AsString;

use Eightfold\Shoop\Filter\Is\IsIdenticalTo;

class EachUsing extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            if (Is::object()->unfoldUsing($using)) {
                return static::fromObject($using);
            }
            return static::fromTuple($using, $this->main);

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using);

        // } elseif (Is::number()->unfoldUsing($using)) {
        //     return static::fromNumber($using, ...$this->args(true));

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using, $this->main);

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return static::fromJson($using, $this->main);
            }
            return static::fromString($using, $this->main);
        }
    }

    static public function fromString(string $using, callable $callable): string
    {
        $array = Divide::fromString($using);
        $array = static::fromList($array, $callable);
        return AsString::fromList($array);
    }

    static public function fromList(
        iterable $using,
        callable $callable
    ): iterable
    {
        $reflect = new ReflectionFunction($callable);
        $params  = $reflect->getParameters();
        $count   = Length::fromList($params);
        $build   = [];
        if (IsIdenticalTo::fromNumber($count, 1)) {
            foreach ($using as $v) {
                $build[] = $callable($v);
            }

        } elseif (IsIdenticalTo::fromNumber($count, 2)) {
            foreach ($using as $m => $v) {
                $build[$m] = $callable($v, $m);
            }

        } elseif (IsIdenticalTo::fromNumber($count, 3)) {
            foreach ($using as $m => $v) {
                $callable($v, $m, $build);
            }

        } else {
            $break = false;
            foreach ($using as $m => $v) {
                if ($break) {
                    break;
                }
                $callable($v, $m, $build, $break);
            }
        }
        return $build;
    }
}
