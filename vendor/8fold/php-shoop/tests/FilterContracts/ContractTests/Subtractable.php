<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shooped;

trait Subtractable
{
    /**
     * @test
     * @group Subtractable
     * @group 1.0.0
     */
    public function minus()
    {
        // AssertEquals::applyWith(
        //     false,
        //     "boolean",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(true)->minus(1)
        // );

        AssertEquals::applyWith(
            0,
            "integer",
            2.92,
            269
        )->unfoldUsing(
            Shooped::fold(1)->minus(1)
        );

        AssertEquals::applyWith(
            0.5,
            "double",
            0.23, // 0.13, // 0.11, // 0.08, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(1.5)->minus(1)
        );

        // AssertEquals::applyWith(
        //     [],
        //     "array",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold([3, 1, 3])->minus(3)
        // );

        // AssertEquals::applyWith(
        //     [1],
        //     "array",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold([3, 1, 3])->minus(1)
        // );

        // AssertEquals::applyWith(
        //     [3, 1],
        //     "array",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold([3, 1, 3])->minus(1, false)
        // );

        // AssertEquals::applyWith(
        //     [1, 3],
        //     "array",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold([3, 1, 3])->minus(1, true, false)
        // );

        // AssertEquals::applyWith(
        //     [1, 1, 1],
        //     "array",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold([1, 3, 1, 3, 1])->minus(3, false, false)
        // );

        // AssertEquals::applyWith(
        //     ["b" => 3],
        //     "array",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->minus(1, false, false)
        // );

        // $using = <<<EOD

        //     Hello!


        // EOD;
        // AssertEquals::applyWith(
        //     "Hello!",
        //     "string",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold($using)->minus()
        // );

        // AssertEquals::applyWith(
        //     "He!",
        //     "string",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold("Hello!")->minus(["l", "o"], false, false)
        // );

        // AssertEquals::applyWith(
        //     (object) ["a" => 1],
        //     "object",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold((object) ["a" => 1, "c" => 3])->minus(3, false, false)
        // );

        // TODO: Objects
    }
}
