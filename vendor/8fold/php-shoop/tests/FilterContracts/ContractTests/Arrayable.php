<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shooped;

/**
 * @version 1.0.0
 */
trait Arrayable
{
    /**
     * @test
     */
    public function asArray()
    {
        AssertEquals::applyWith(
            [false, true],
            "array",
            3.2, // 3.09, // 3.03,
            236
        )->unfoldUsing(
            Shooped::fold(true)->asArray()
        );

        AssertEquals::applyWith(
            [3],
            "array",
            0.19, // 0.18, // 0.16,
            4
        )->unfoldUsing(
            Shooped::fold(3)->asArray()
        );

        AssertEquals::applyWith(
            [2.5],
            "array",
            0.13, // 0.11, // 0.08, // 0.05, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->asArray()
        );

        AssertEquals::applyWith(
            [3, 1, 3],
            "array",
            0.15, // 0.11, // 0.08,
            2
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->asArray()
        );

        AssertEquals::applyWith(
            [1, 3, 1],
            "array",
            0.24, // 0.11, // 0.08, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->asArray()
        );

        AssertEquals::applyWith(
            ["Hi!"],
            "array",
            0.75, // 0.25, // 0.16, // 0.08,
            5
        )->unfoldUsing(
            Shooped::fold("Hi!")->asArray()
        );

        AssertEquals::applyWith(
            ["!H!i!"],
            "array",
            0.27, // 0.23, // 0.18, // 0.15, // 0.14, // 0.13, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold("!H!i!")->asArray()
        );

        AssertEquals::applyWith(
            [1, 3],
            "array",
            0.41, // 0.37,
            16
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->asArray()
        );

        // TODO: Objects
    }

    /**
     * @test
     */
    public function efToArray()
    {
        AssertEquals::applyWith(
            [false, true],
            "array",
            3.35, // 2.93, // 2.85, // 2.65, // 2.58,
            236
        )->unfoldUsing(
            Shooped::fold(true)->efToArray()
        );

        AssertEquals::applyWith(
            [3],
            "array",
            0.18, // 0.14,
            4
        )->unfoldUsing(
            Shooped::fold(3)->efToArray()
        );

        AssertEquals::applyWith(
            [2.5],
            "array",
            0.19, // 0.13, // 0.1, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->efToArray()
        );

        AssertEquals::applyWith(
            [3, 1, 3],
            "array",
            0.2, // 0.18, // 0.11, // 0.1, // 0.08,
            1
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->efToArray()
        );

        AssertEquals::applyWith(
            [1, 3, 1],
            "array",
            0.21, // 0.12, // 0.08, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->efToArray()
        );

        AssertEquals::applyWith(
            ["Hi!"],
            "array",
            0.54, // 0.19, // 0.17, // 0.14, // 0.11, // 0.1, // 0.09, // 0.08,
            5
        )->unfoldUsing(
            Shooped::fold("Hi!")->efToArray()
        );

        AssertEquals::applyWith(
            [1, 3],
            "array",
            0.37, // 0.35,
            16
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->efToArray()
        );

        // TODO: Objects
    }
}
