<?php

namespace Eightfold\Shoop;

use Eightfold\Foldable\Pipe;
use Eightfold\Foldable\Foldable;

use Eightfold\Shoop\Filter\TypeIs;

use Eightfold\Shoop\Shooped;

class Shoop
{
    static public function pipe($using, callable ...$elbows): Pipe
    {
        return Pipe::fold($using, ...$elbows);
    }

    static public function this($main)
    {
        return Shooped::fold($main);
    }
}
