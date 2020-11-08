<?php

namespace Eightfold\Foldable;

use League\Pipeline\Pipeline as LeaguePipeline;

use Eightfold\Foldable\Foldable;
use Eightfold\Foldable\FoldableImp;

class Pipe implements Foldable
{
    use FoldableImp;

    public function unfold()
    {
        $payload = $this->main;
        foreach ($this->args as $filter) {
            if (is_callable($filter)) {
                $payload = $filter($payload);
            }
        }
        return $payload;
    }
}
