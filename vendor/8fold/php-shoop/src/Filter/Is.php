<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Apply;

class Is extends Filter
{
    static public function __callStatic(string $name, array $arguments)
    {
        $className = ucfirst($name);
        $className = Prepend::fromString($className, "Is");
        $className = __NAMESPACE__ ."\\Is\\". $className;

        return (CountIsGreaterThan::fromList($arguments, 0))
            ? $className::applyWith(...$arguments)
            : $className::apply();
    }
}
