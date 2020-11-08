<?php
declare(strict_types=1);

namespace Eightfold\Foldable\Tests\Extensions;

use Eightfold\Foldable\Filter;

use Eightfold\Foldable\Tests\Extensions\Append;

class Prepend extends Filter
{
    public function __invoke(string $using): string
    {
        return Append::applyWith($using)->unfoldUsing($this->main);
    }
}
