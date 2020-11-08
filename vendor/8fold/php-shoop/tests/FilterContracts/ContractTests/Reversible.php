<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shooped;

trait Reversible
{
    /**
     * @test
     * @group Reversible
     * @group 1.0.0
     */
    public function reversed()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            2.96, // 2.77,
            264
        )->unfoldUsing(
            Shooped::fold(false)->reversed()
        );

        AssertEquals::applyWith(
            -3,
            "integer",
            0.27, // 0.25, // 0.23, // 0.21,
            6
        )->unfoldUsing(
            Shooped::fold(3)->reversed()
        );

        AssertEquals::applyWith(
            2.0,
            "double",
            0.51, // 0.09, // 0.07, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(-2.0)->reversed()
        );

        AssertEquals::applyWith(
            [1, 2, 3],
            "array",
            0.21, // 0.13, // 0.12, // 0.11, // 0.09, // 0.08,
            2
        )->unfoldUsing(
            Shooped::fold([3, 2, 1])->reversed()
        );

        AssertEquals::applyWith(
            ["b" => 3, "a" => 1],
            "array",
            0.35, // 0.21, // 0.1, // 0.08, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3])->reversed()
        );

        AssertEquals::applyWith(
            "8fold!",
            "string",
            0.26, // 0.22, // 0.18, // 0.16, // 0.11, // 0.1,
            4
        )->unfoldUsing(
            Shooped::fold("!dlof8")->reversed()
        );

        AssertEquals::applyWith(
            (object) ["c" => 3, "a" => 1],
            "object",
            0.98, // 0.87, // 0.76,
            117
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->reversed()
        );

        // TODO: Objects
    }
}
