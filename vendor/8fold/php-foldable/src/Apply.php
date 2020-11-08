<?php
declare(strict_types=1);

namespace Eightfold\Foldable;

use Eightfold\Foldable\Filterable;

abstract class Apply
{
    // TODO: type check return Filterable
    static public function __callStatic(string $filterName, array $arguments = [])
    {
        $className = static::classNameForFilter($filterName);
        return (count($arguments) === 0)
            ? $className::apply()
            : $className::applyWith(...$arguments);
    }

    static public function classNameForFilter($filterName)
    {
        $filterName = ucfirst($filterName);
        $className = static::rootNameSpaceForFilters() ."\\". $filterName;
        return $className;
    }

    // TODO: type check return - boolean
    static public function filterClassExists(string $className)
    {
        return class_exists($className) and
            in_array(Filterable::class, class_implements($className));
    }

    // TODO: type check return - string
    static public function rootNameSpaceForFilters()
    {
        return __NAMESPACE__ ."\\Filter";
    }
}
