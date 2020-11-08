<?php
declare(strict_types=1);

namespace Eightfold\Foldable\Tests\Extensions;

use Eightfold\Foldable\Fold;

use Eightfold\Foldable\Tests\Extensions\Append;

class MyFoldable extends Fold
{
    public function append(string $string): MyFoldable
    {
        $this->main = $this->main . $string;

        return $this;
    }

    public function appendUsingFilter(string $using): MyFoldable
    {
        $this->main = Append::applyWith($using)->unfoldUsing($this->main);
        return $this;
    }
}
