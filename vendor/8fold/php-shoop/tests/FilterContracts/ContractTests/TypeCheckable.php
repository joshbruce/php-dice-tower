<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shooped;

trait TypeCheckable
{
    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function isArray()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            0.47, // 0.02,
            64
        )->unfoldUsing(
            Shooped::fold("Hello")->isArray()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function efIsArray()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            0.12, // 0.11, // 0.16, // 0.12, // 0.1, // 0.03,
            64
        )->unfoldUsing(
            Shooped::fold(["a", "b", "c"])->efIsArray()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function isBoolean()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            0.09, // 0.05, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold("Hello")->isBoolean()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function efIsBoolean()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            0.08, // 0.05, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(false)->efIsBoolean()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function isDictionary()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            0.08, // 0.05, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold("Hello")->isDictionary()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function efIsDictionary()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            0.1, // 0.08, // 0.07, // 0.06, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 2, "c" => 3])->efIsDictionary()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function isNumber()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            0.08, // 0.05, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold("Hello")->isNumber()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function efIsNumber()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            0.07, // 0.05, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(3.1)->efIsNumber()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function isInteger()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            0.07, // 0.06, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(3.1)->isInteger()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function efIsInteger()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            0.08, // 0.07, // 0.06, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(3.0)->efIsInteger()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function _isJson()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            0.09, // 0.07, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold("Hello")->isJson()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function efIsJson()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            0.1, // 0.09, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold('{}')->efIsJson()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function isString()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            0.08, // 0.05, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold([])->isString()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function efIsString()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            0.06, // 0.05, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            Shooped::fold("Hello")->efIsString()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.08, // 0.06, // 0.01,
            1
        )->unfoldUsing(
            Shooped::fold('{}')->efIsString()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function isTuple()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            0.25, // 0.09, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold("Hello")->isTuple()
        );
    }

    /**
     * @test
     * @group TypeCheckable
     * @group 1.0.0
     */
    public function efIsTuple()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            0.06, // 0.05, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold((object) ["a", "b", "c"])->efIsTuple()
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.15, // 0.11, // 0.1, // 0.09, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold('{}')->efIsTuple()
        );
    }
}
