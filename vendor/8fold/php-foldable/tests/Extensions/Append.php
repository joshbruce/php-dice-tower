<?php
declare(strict_types=1);

namespace Eightfold\Foldable\Tests\Extensions;

use Eightfold\Foldable\Filter;

use Eightfold\Foldable\Pipe;

class Append extends Filter
{
    public function __invoke($using): string
    {
        if (is_a($using, Pipe::class)) {
            return $using->unfold() . $this->main;
        }
        return $using . $this->main;
    }
}
