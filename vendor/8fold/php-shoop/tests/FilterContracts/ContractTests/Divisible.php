<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shooped;

trait Divisible
{
    /**
     * @test
     * @group Divisible
     * @group 1.0.0
     * @group current
     */
    public function divide()
    {
        // AssertEquals::applyWith(
        //     true,
        //     "boolean",
        //     11.96 // 5.62 // 2.98 // 2.94 // 2.89 // 2.18 // 1.54
        // )->unfoldUsing(
        //     Shooped::fold(false)->plus(1)
        // );

        AssertEquals::applyWith(
            1,
            "integer",
            2.97, // 0.85, // 0.16, // 0.15, // 0.12, // 0.1, // 0.03, // 0.02,
            4 // 2
        )->unfoldUsing(
            Shooped::fold(1)->divide(1)
        );

        AssertEquals::applyWith(
            0.75,
            "double",
            0.15, // 0.12, // 0.11, // 0.1, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(1.5)->divide(2)
        );

        AssertEquals::applyWith(
            ["key", "content with a space"],
            "array",
            0.92, // 0.17, // 0.13, // 0.12, // 0.11, // 0.02,
            9
        )->unfoldUsing(
            Shooped::fold("key content with a space")->divide(" ", false, 2)
        );

        // AssertEquals::applyWith(
        //     [1, 2, 3],
        //     "array",
        //     1.33, // 0.57, // 0.52,
        //     29 // 14
        // )->unfoldUsing(
        //     Shooped::fold([1])->plus([2, 3])
        // );

        // AssertEquals::applyWith(
        //     "8fold!",
        //     "string",
        //     0.34
        // )->unfoldUsing(
        //     Shooped::fold("8fold")->plus("!")
        // );

        // AssertEquals::applyWith(
        //     (object) ["a" => 1, "b" => 2, "c" => 3],
        //     "object",
        //     1.1 // 0.99 // 0.82
        // )->unfoldUsing(
        //     Shooped::fold((object) ["a" => 1])->plus(["b" => 2, "c" => 3])
        // );

        // AssertEquals::applyWith(
        //     (object) ["a" => 1, "b" => 2, "c" => 3],
        //     "object",
        //     0.73 // 0.6 // 0.49
        // )->unfoldUsing(
        //     Shooped::fold((object) ["a" => 1])->plus((object) ["b" => 2, "c" => 3])
        // );

        // AssertEquals::applyWith(
        //     (object) ["a" => 1, "i0" => 3],
        //     "object",
        //     0.54, // 0.53, // 0.5, // 0.49
        // )->unfoldUsing(
        //     Shooped::fold((object) ["a" => 1])->plus(3)
        // );

        // TODO: Objects
    }
}
