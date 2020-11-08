<?php

namespace Eightfold\Shoop\Tests\PipeFilters;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Filter\Reversed;

/**
 * @group Reversed
 *
 * @group 1.0.0
 */
class ReversedTest extends TestCase
{
    /**
     * @test
     */
    public function numbers()
    {
        AssertEquals::applyWith(
            -1,
            "integer",
            1.99,
            23 // 13
        )->unfoldUsing(
            Reversed::fromNumber(1)
        );

        AssertEquals::applyWith(
            1.0,
            "double",
            0.01, // 0.005, // 0.004, // 0.002,
            1
        )->unfoldUsing(
            Reversed::fromNumber(-1.0)
        );
    }

    /**
     * @test
     */
    public function strings()
    {
        AssertEquals::applyWith(
            "8fold!",
            "string",
            2.09, // 1.99, // 1.44, // 0.41, // 0.36,
            80 // 44 // 24
        )->unfoldUsing(
            Reversed::fromString("!dlof8")
        );

        AssertEquals::applyWith(
            "👆👆👍👇👇",
            "string",
            0.11, // 0.03, // 0.02, // 0.01, // 0.005, // 0.004,
            1
        )->unfoldUsing(
            Reversed::fromString("👇👇👍👆👆")
        );

        AssertEquals::applyWith(
            "👆👆👇👇",
            "string",
            0.03, // 0.02, // 0.004, // 0.003,
            80
        )->unfoldUsing(
            Reversed::fromString("👇👇👆👆")
        );
    }
}
