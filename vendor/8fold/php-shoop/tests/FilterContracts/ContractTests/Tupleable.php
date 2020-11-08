<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shooped;

trait Tupleable
{
    /**
     * @test
     * @group Tupleable
     * @group 1.0.0
     */
    public function asTuple()
    {
        AssertEquals::applyWith(
            (object) ["false" => false, "true" => true],
            "object",
            3.67, // 3.17, // 3.15,
            301
        )->unfoldUsing(
            Shooped::fold(true)->asTuple()
        );

        AssertEquals::applyWith(
            (object) ["0.0" => 1],
            "object",
            1.06, // 0.25, // 0.23,
            12
        )->unfoldUsing(
            Shooped::fold(1)->asTuple()
        );

        AssertEquals::applyWith(
            (object) ["content" => "Hi!"],
            "object",
            0.3, // 0.2,
            7
        )->unfoldUsing(
            Shooped::fold("Hi!")->asTuple()
        );

        AssertEquals::applyWith(
            (object) ["a" => 1, "b" => 3],
            "object",
            0.25, // 0.2, // 0.16, // 0.14, // 0.13, // 0.11, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3])->asTuple()
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group Tupleable
     * @group 1.0.0
     */
    public function efToTuple()
    {
        AssertEquals::applyWith(
            (object) ["false" => false, "true" => true],
            "object",
            19.19,
            301
        )->unfoldUsing(
            Shooped::fold(true)->efToTuple()
        );

        AssertEquals::applyWith(
            (object) ["0.0" => 1],
            "object",
            1.95,
            12
        )->unfoldUsing(
            Shooped::fold(1)->efToTuple()
        );

        AssertEquals::applyWith(
            (object) ["content" => "Hi!"],
            "object",
            1.57,
            6
        )->unfoldUsing(
            Shooped::fold("Hi!")->efToTuple()
        );

        AssertEquals::applyWith(
            (object) ["a" => 1, "b" => 3],
            "object",
            0.22, // 0.19, // 0.14, // 0.1, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3])->efToTuple()
        );

        // TODO: Object
    }

    /**
     * @test
     * @group Tupleable
     * @group 1.0.0
     */
    public function asJson()
    {
        AssertEquals::applyWith(
            '{"false":false,"true":true}',
            "string",
            20.79,
            336
        )->unfoldUsing(
            Shooped::fold(true)->asJson()
        );

        AssertEquals::applyWith(
            '{"0.0":1}',
            "string",
            1.3,
            10
        )->unfoldUsing(
            Shooped::fold(1)->asJson()
        );

        AssertEquals::applyWith(
            '{"content":"Hi!"}',
            "string",
            0.85,
            2
        )->unfoldUsing(
            Shooped::fold("Hi!")->asJson()
        );

        AssertEquals::applyWith(
            '{"a":1,"b":3}',
            "string",
            0.31, // 0.16, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3])->asJson()
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group Tupleable
     * @group 1.0.0
     */
    public function efToJson()
    {
        AssertEquals::applyWith(
            '{"false":false,"true":true}',
            "string",
            4.08, // 4.02, // 3.76,
            336
        )->unfoldUsing(
            Shooped::fold(true)->efToJson()
        );

        AssertEquals::applyWith(
            '{"0.0":1}',
            "string",
            0.52,
            10
        )->unfoldUsing(
            Shooped::fold(1)->efToJson()
        );

        AssertEquals::applyWith(
            '{"content":"Hi!"}',
            "string",
            5.88, // 1.07,
            2
        )->unfoldUsing(
            Shooped::fold("Hi!")->efToJson()
        );

        AssertEquals::applyWith(
            '{"a":1,"b":3}',
            "string",
            0.68, // 0.23, // 0.2, // 0.19, // 0.18, // 0.13, // 0.1, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3])->efToJson()
        );

        // TODO: Objects
    }
}
