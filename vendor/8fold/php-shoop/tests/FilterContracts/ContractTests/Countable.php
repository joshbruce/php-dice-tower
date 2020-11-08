<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shooped;

trait Countable
{
    /**
     * @test
     * @group Countable
     * @group 1.0.0
     */
    public function asInteger()
    {
        AssertEquals::applyWith(
            1,
            "integer",
            21.87,
            261
        )->unfoldUsing(
            Shooped::fold(true)->asInteger()
        );

        AssertEquals::applyWith(
            3,
            "integer",
            1.26,
            4
        )->unfoldUsing(
            Shooped::fold(3)->asInteger()
        );

        AssertEquals::applyWith(
            3,
            "integer",
            0.14, // 0.13, // 0.1, // 0.09, // 0.07, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->asInteger()
        );

        AssertEquals::applyWith(
            1,
            "integer",
            0.45,
            2
        )->unfoldUsing(
            Shooped::fold([3, 1, 3, 1])->asInteger()
        );

        AssertEquals::applyWith(
            1,
            "integer",
            0.13, // 0.11, // 0.1, // 0.09, // 0.08, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->asInteger()
        );

        AssertEquals::applyWith(
            0,
            "integer",
            0.81,
            4
        )->unfoldUsing(
            Shooped::fold("Hi!")->asInteger()
        );

        AssertEquals::applyWith(
            1,
            "integer",
            3.09,
            42
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->asInteger()
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group Countable
     * @group 1.0.0
     */
    public function efToInteger()
    {
        AssertEquals::applyWith(
            1,
            "integer",
            3, // 2.95, // 2.91, // 2.76,
            261
        )->unfoldUsing(
            Shooped::fold(true)->efToInteger()
        );

        AssertEquals::applyWith(
            3,
            "integer",
            0.25, // 0.18, // 0.16, // 0.15,
            4
        )->unfoldUsing(
            Shooped::fold(3)->efToInteger()
        );

        AssertEquals::applyWith(
            3,
            "integer",
            0.53, // 0.18, // 0.1, // 0.09, // 0.06, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->efToInteger()
        );

        AssertEquals::applyWith(
            1,
            "integer",
            0.12, // 0.11, // 0.09, // 0.08,
            1
        )->unfoldUsing(
            Shooped::fold([3, 1, 3, 1])->efToInteger()
        );

        AssertEquals::applyWith(
            1,
            "integer",
            0.21, // 0.13, // 0.1, // 0.09, // 0.07, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->efToInteger()
        );

        AssertEquals::applyWith(
            0,
            "integer",
            0.44,
            4
        )->unfoldUsing(
            Shooped::fold("Hi!")->efToInteger()
        );

        AssertEquals::applyWith(
            1,
            "integer",
            3,
            42
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->efToInteger()
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group Countable
     * @group 1.0.0
     */
    public function length()
    {
        // AssertEquals::applyWith(
        //     1,
        //     "integer",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(true)->efToInteger()
        // );

        AssertEquals::applyWith(
            3,
            "integer",
            0.14, // 0.11, // 0.09, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(3)->length()
        );

        AssertEquals::applyWith(
            3,
            "integer",
            2.49, // 0.12, // 0.11, // 0.1, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->efToInteger()
        );

        AssertEquals::applyWith(
            4,
            "integer",
            0.25, // 0.11, // 0.1, // 0.09, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold([3, 1, 3, 1])->length()
        );

        AssertEquals::applyWith(
            3,
            "integer",
            0.14, // 0.1, // 0.09, // 0.08, // 0.01,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->length()
        );

        AssertEquals::applyWith(
            3,
            "integer",
            0.11, // 0.1, // 0.07, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold("Hi!")->length()
        );

        // AssertEquals::applyWith(
        //     1,
        //     "integer",
        //     3,
        //     42
        // )->unfoldUsing(
        //     Shooped::fold((object) ["a" => 1, "c" => 3])->efToInteger()
        // );

        // TODO: Objects
    }
}
