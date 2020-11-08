<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shooped;

trait Comparable
{
    /**
     * @test
     * @group Comparable
     * @group 1.0.0
     */
    public function is()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            3.24, // 2.93, // 2.81,
            240
        )->unfoldUsing(
            Shooped::fold(true)->is(false)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            2.88,
            4
        )->unfoldUsing(
            Shooped::fold(3)->is(3)
        );

        // TODO: Should these be the same - ??
        //      all whole numbers are literal integers - ??
        AssertEquals::applyWith(
            false,
            "boolean",
            0.14, // 0.1, // 0.08, // 0.06, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(2.0)->is(2)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.29, // 0.13, // 0.09, // 0.08, // 0.07,
            2
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->is(false)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.14, // 0.12, // 0.09, // 0.08, // 0.07, // 0.06, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])
                ->is((object) ["a" => 1, "b" => 3, "c" => 1])
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.48,
            4
        )->unfoldUsing(
            Shooped::fold("Hi!")->is("Hi!")
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.19, // 0.1, // 0.09,
            3
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->is(["a" => 1, "c" => 3])
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group Comparable
     * @group 1.0.0
     */
    public function isGreaterThan()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            13.81, // 13.44, // 4.11,
            267 // 266 // 265 // 264
        )->unfoldUsing(
            Shooped::fold(true)->isGreaterThan(false)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            1.95, // 1.37,
            4
        )->unfoldUsing(
            Shooped::fold(3)->isGreaterThan(5)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.11, // 0.1, // 0.09, // 0.06, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(2.0)->isGreaterThan(1.9)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.55, // 0.46, // 0.39,
            2
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->isGreaterThan([3, 1, 3, 1])
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.24, // 0.15, // 0.12, // 0.1, // 0.07, // 0.06, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])
                ->isGreaterThan(["a" => 1, "b" => 3])
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.54, // 0.52,
            4
        )->unfoldUsing(
            Shooped::fold("a")->isGreaterThan("b")
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.13, // 0.12, // 0.11, // 0.1, // 0.08, // 0.04, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold("b")->isGreaterThan("a")
        );

        // TODO: Not sure rationale here - could use more work and conversation
        AssertEquals::applyWith(
            true,
            "boolean",
            2.9,
            106
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])
                ->isGreaterThan(["a" => 1, "c" => 3])
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group Comparable
     * @group 1.0.0
     */
    public function isGreaterThanOrEqualTo()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            17.79, // 5.12, // 3.78, // 3.52,
            293
        )->unfoldUsing(
            Shooped::fold(false)->isGreaterThanOrEqualTo(true)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            1.81,
            69
        )->unfoldUsing(
            Shooped::fold(3)->isGreaterThanOrEqualTo(3)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.49, // 0.39, // 0.21, // 0.2, // 0.06, // 0.05,
            1
        )->unfoldUsing(
            Shooped::fold(2.0)->isGreaterThanOrEqualTo(2.9)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            1.93, // 0.65, // 0.51,
            2
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->isGreaterThanOrEqualTo([3, 1])
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.33, // 0.32, // 0.29, // 0.27, // 0.04,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])
                ->isGreaterThanOrEqualTo(["a" => 1, "b" => 3])
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.92,
            4
        )->unfoldUsing(
            Shooped::fold("b")->isGreaterThanOrEqualTo("b")
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            046, // 0.43, // 0.35, // 0.34, // 0.28, // 0.05, // 0.04,
            1
        )->unfoldUsing(
            Shooped::fold("b")->isGreaterThanOrEqualTo("a")
        );

        // TODO: Not sure rationale here - could use more work and conversation
        AssertEquals::applyWith(
            true,
            "boolean",
            3.31,
            42
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])
                ->isGreaterThanOrEqualTo(["a" => 1, "c" => 3])
        );

        // TODO: Objects
    }
}
