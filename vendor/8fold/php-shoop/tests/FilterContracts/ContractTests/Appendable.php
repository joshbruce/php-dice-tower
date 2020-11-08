<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shooped;

trait Appendable
{
    /**
     * @test
     * @group Appendable
     * @group 1.0.0
     */
    public function append()
    {
        AssertEquals::applyWith(
            2,
            "integer",
            4.16, // 3.99, // 3.9, // 3.42, // 3.4, // 3.37, // 2.8, // 2.58,
            384 // 236 // 235
        )->unfoldUsing(
            Shooped::fold(1)->append(1)
        );

        AssertEquals::applyWith(
            2.5,
            "double",
            0.46, // 0.29, // 0.2, // 0.15, // 0.14, // 0.04,
            1
        )->unfoldUsing(
            Shooped::fold(1.5)->append(1)
        );

        AssertEquals::applyWith(
            [1, 2, 3],
            "array",
            0.17, // 0.11, // 0.08, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold([1])->append([2, 3])
        );

        AssertEquals::applyWith(
            "8fold!",
            "string",
            0.25, // 0.16, // 0.14, // 0.13, // 0.12, // 0.09,
            4
        )->unfoldUsing(
            Shooped::fold("8fold")->append("!")
        );

        AssertEquals::applyWith(
            (object) ["a" => 1, "b" => 2, "c" => 3],
            "object",
            1.38,
            53 // 44
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1])->append(["b" => 2, "c" => 3])
        );

        AssertEquals::applyWith(
            (object) ["a" => 2, "c" => 3],
            "object",
            0.4, // 0.2, // 0.05,
            1
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1])
                ->append((object) ["a" => 2, "c" => 3])
        );

        AssertEquals::applyWith(
            (object) ["a" => 1, "0.0" => 3],
            "object",
            0.96, // 0.37, // 0.29, // 0.23, // 0.18, // 0.06, // 0.05,
            1
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1])->append(3)
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group Appendable
     * @group 1.0.0
     */
    public function endsWith()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            0.34,
            12
        )->unfoldUsing(
            Shooped::fold("8fold")->endsWith("fold")
        );
    }

    /**
     * @test
     * @group Appendable
     * @group 1.0.0
     */
    public function efEndsWith()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            0.11, // 0.1, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold("8fold")->efEndsWith("8")
        );
    }
}
