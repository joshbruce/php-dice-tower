<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Shooped;

trait Stringable
{
    /**
     * @test
     * @group Stringable
     * @group 1.0.0
     */
    public function asString()
    {
        AssertEquals::applyWith(
            "true",
            "string",
            3.49, // 3.02, // 2.95, // 2.82,
            264
        )->unfoldUsing(
            Shooped::fold(true)->asString()
        );

        AssertEquals::applyWith(
            "3.0",
            "string",
            0.96, // 0.27, // 0.23,
            4
        )->unfoldUsing(
            Shooped::fold(3)->asString()
        );

        AssertEquals::applyWith(
            "2.5",
            "string",
            0.22, // 0.13, // 0.11, // 0.1, // 0.09, // 0.07, // 0.05, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->asString()
        );

        AssertEquals::applyWith(
            "Hi!",
            "string",
            0.18, // 0.13, // 0.12, // 0.09, // 0.08, // 0.07,
            2
        )->unfoldUsing(
            Shooped::fold(["H", 1, "i", true, "!"])->asString()
        );

        AssertEquals::applyWith(
            "",
            "string",
            0.18, // 0.15, // 0.1, // 0.08, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->asString()
        );

        AssertEquals::applyWith(
            "8fold!",
            "string",
            0.8, // 0.74, // 0.7,
            46
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "b" => "8fold!", "c" => 3])->asString()
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group Stringable
     * @group 1.0.0
     */
    public function efToString()
    {
        AssertEquals::applyWith(
            "true",
            "string",
            13.15,
            264
        )->unfoldUsing(
            Shooped::fold(true)->efToString()
        );

        AssertEquals::applyWith(
            "3.0",
            "string",
            0.22, // 0.18,
            4
        )->unfoldUsing(
            Shooped::fold(3)->efToString()
        );

        AssertEquals::applyWith(
            "2.5",
            "string",
            0.25, // 0.12, // 0.11, // 0.1, // 0.08, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->efToString()
        );

        AssertEquals::applyWith(
            "Hi!",
            "string",
            0.21, // 0.18, // 0.15, // 0.14, // 0.09, // 0.08,
            1
        )->unfoldUsing(
            Shooped::fold(["H", 1, "i", true, "!"])->efToString()
        );

        AssertEquals::applyWith(
            "",
            "string",
            0.17, // 0.14, // 0.12, // 0.11, // 0.09, // 0.08, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->efToString()
        );

        AssertEquals::applyWith(
            "8fold!",
            "string",
            0.86, // 0.82, // 0.78, // 0.77,
            46
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "b" => "8fold!", "c" => 3])->efToString()
        );

        // TODO: Objects
    }
}
