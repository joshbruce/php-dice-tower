<?php

namespace Eightfold\Foldable;

trait FilterableImp
{
    static public function apply()
    {
        return static::applyWith();
    }

    static public function applyWith(...$args)
    {
        return new static(...$args);
    }

    public function unfoldUsing($payload)
    {
        return $this($payload);
    }
}
