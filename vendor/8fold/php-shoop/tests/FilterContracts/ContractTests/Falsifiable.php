<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shooped;

trait Falsifiable
{
    /**
     * @test
     * @group Falsifiable
     * @group 1.0.0
     */
    public function asBoolean()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            21.21,
            277
        )->unfoldUsing(
            Shooped::fold(true)->asBoolean()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            1.49,
            4
        )->unfoldUsing(
            Shooped::fold(0)->asBoolean()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.19, // 0.12, // 0.1, // 0.09, // 0.07, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->asBoolean()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.43,
            2
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->asBoolean()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.17, // 0.13, // 0.11, // 0.07, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold([])->asBoolean()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.97, // 0.56,
            4
        )->unfoldUsing(
            Shooped::fold("")->asBoolean()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            3.63,
            106
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->asBoolean()
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group Falsifiable
     * @group 1.0.0
     */
    public function efToBoolean()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            13.8,
            277
        )->unfoldUsing(
            Shooped::fold(true)->efToBoolean()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            1.29,
            4
        )->unfoldUsing(
            Shooped::fold(0)->efToBoolean()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.16, // 0.12, // 0.11, // 0.1, // 0.08, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->efToBoolean()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.44,
            1
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->efToBoolean()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.11, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold([])->efToBoolean()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.87,
            4
        )->unfoldUsing(
            Shooped::fold("")->efToBoolean()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            3.52,
            106
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->efToBoolean()
        );

        // TODO: Objects
    }
}
