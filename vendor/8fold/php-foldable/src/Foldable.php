<?php
declare(strict_types=1);

namespace Eightfold\Foldable;

interface Foldable
{
    static public function fold(...$args): Foldable;

    public function main();

    public function args($includeMain = false);

    public function unfold();
}
