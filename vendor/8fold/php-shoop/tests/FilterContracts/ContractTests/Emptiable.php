<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shooped;

trait Emptiable
{
    /**
     * @test
     * @group Emptiable
     * @group 1.0.0
     */
    public function _isEmpty()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            3.26, // 2.92, // 2.81, // 2.64, // 2.56,
            261
        )->unfoldUsing(
            Shooped::fold(true)->isEmpty()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.16, // 0.14,
            4
        )->unfoldUsing(
            Shooped::fold(0)->isEmpty()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.11, // 0.1, // 0.08, // 0.07, // 0.06, // 0.04, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->isEmpty()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.13, // 0.11, // 0.1, // 0.08,
            2
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->isEmpty()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.11, // 0.08, // 0.06, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold([])->isEmpty()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.14, // 0.1,
            4
        )->unfoldUsing(
            Shooped::fold("")->isEmpty()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.7, // 0.67,
            42
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->isEmpty()
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group Emptiable
     * @group 1.0.0
     */
    public function efIsEmpty()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            3.46, // 2.92, // 2.81,
            261
        )->unfoldUsing(
            Shooped::fold(true)->efIsEmpty()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.45, // 0.16, // 0.15, // 0.14,
            4
        )->unfoldUsing(
            Shooped::fold(0)->efIsEmpty()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.13, // 0.09, // 0.06, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->efIsEmpty()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.1, // 0.09, // 0.08, // 0.07,
            1
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->efIsEmpty()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.12, // 0.1, // 0.08, // 0.06, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold([])->efIsEmpty()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.2, // 0.17, // 0.1,
            4
        )->unfoldUsing(
            Shooped::fold("")->efIsEmpty()
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            1.02, // 0.68, // 0.65,
            42
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->efIsEmpty()
        );

        // TODO: Objects
    }
}
