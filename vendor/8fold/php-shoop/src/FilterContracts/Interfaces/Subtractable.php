<?php

namespace Eightfold\Shoop\FilterContracts\Interfaces;

interface Subtractable
{
    /**
     * end   - start
     * true  - true : Characters are removed from beginning & end, not middle.
     * false - false: All characters are moved from string.
     * true  - false: Characters are stripped from end, not beginning.
     * false - true : Characters are stripped from beginning, not end.
     */
    public function minus($value): Subtractable;

    // TODO: Make remove
    // public function minus(
    //     $charMask = [" ", "\t", "\n", "\r", "\0", "\x0B"],
    //     bool $fromStart = true,
    //     bool $fromEnd   = true
    // ): Subtractable;
}
