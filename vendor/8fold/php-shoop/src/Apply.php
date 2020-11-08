<?php
declare(strict_types=1);

namespace Eightfold\Shoop;

use Eightfold\Foldable\Apply as BaseApply;

use Eightfold\Shoop\Filter\Append;
use Eightfold\Shoop\Filter\StartsWith;

use Eightfold\Shoop\Filter\Is\IsIdenticalTo;

class Apply extends BaseApply
{
    static public function classNameForFilter($filterName)
    {
        $filterName = ucfirst($filterName);
        $namespace = Append::fromString(__NAMESPACE__, "\\Filter\\");
        if (StartsWith::fromString($filterName, "Is")) {
            $namespace = Append::fromString($namespace, "Is\\");

        } elseif (StartsWith::fromString($filterName, "As")) {
            $namespace = Append::fromString($namespace, "TypeJuggling\\");

        } elseif (IsIdenticalTo::fromString($filterName, "EachUsing")) {
            $namespace = Append::fromString($namespace, "Traverse\\");

        } elseif (IsIdenticalTo::fromString($filterName, "RetainUsing")) {
            $namespace = Append::fromString($namespace, "Traverse\\");

        } elseif (IsIdenticalTo::fromString($filterName, "DropUsing")) {
            $namespace = Append::fromString($namespace, "Traverse\\");

        }
        return Append::fromString($namespace, $filterName);
    }
}
