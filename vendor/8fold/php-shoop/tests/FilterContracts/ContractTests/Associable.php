<?php

namespace Eightfold\Shoop\Tests\FilterContracts\ContractTests;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Shooped;

trait Associable
{
    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function asDictionary()
    {
        AssertEquals::applyWith(
            ["false" => false, "true" => true],
            "array",
            18.55, // 16.51, // 6.58,
            255 // 253 // 226
        )->unfoldUsing(
            Shooped::fold(true)->asDictionary()
        );

        AssertEquals::applyWith(
            ["0.0" => 3],
            "array",
            0.48, // 0.43, // 0.41, // 0.37, // 0.3, // 0.26, // 0.24,
            23 // 10
        )->unfoldUsing(
            Shooped::fold(3)->asDictionary()
        );

        AssertEquals::applyWith(
            ["0.0" => 2.5],
            "array",
            0.19, // 0.17, // 0.16, // 0.13, // 0.1, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->asDictionary()
        );

        AssertEquals::applyWith(
            ["0.0" => 3, "1.0" => 1, "2.0" => 3],
            "array",
            0.67, // 0.4, // 0.36, // 0.1, // 0.09, // 0.08, // 0.08,
            2
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->asDictionary()
        );

        AssertEquals::applyWith(
            ["a" => 1, "b" => 3, "c" => 1],
            "array",
            0.23, // 0.14, // 0.09, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->asDictionary()
        );

        AssertEquals::applyWith(
            ["content" => "Hi!"],
            "array",
            1.22,
            5
        )->unfoldUsing(
            Shooped::fold("Hi!")->asDictionary()
        );

        AssertEquals::applyWith(
            ["a" => 1, "c" => 3],
            "array",
            3.25,
            18 // 16
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->asDictionary()
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function efToDictionary()
    {
        AssertEquals::applyWith(
            ["false" => false, "true" => true],
            "array",
            3.1, // 2.97, // 2.86, // 2.85, // 2.69, // 2.52, // 2.5, // 2.39,
            226
        )->unfoldUsing(
            Shooped::fold(true)->efToDictionary()
        );

        // TODO: Should arrays start at 1
        AssertEquals::applyWith(
            ["0.0" => 3],
            "array",
            2.08, // 0.45, // 0.27, // 0.26, // 0.24,
            22 // 10
        )->unfoldUsing(
            Shooped::fold(3)->efToDictionary()
        );

        // TODO: Should arrays start at 1
        AssertEquals::applyWith(
            // ["i1" => 1, "i2" => 2]
            ["0.0" => 2.5],
            "array",
            2.19, // 0.21, // 0.17, // 0.16, // 0.13, // 0.11, // 0.09, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->efToDictionary()
        );

        AssertEquals::applyWith(
            ["0.0" => 3, "1.0" => 1, "2.0" => 3],
            "array",
            0.44, // 0.1, // 0.09, // 0.08,
            2
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->efToDictionary()
        );

        AssertEquals::applyWith(
            ["a" => 1, "b" => 3, "c" => 1],
            "array",
            0.21, // 0.2, //0.14, // 0.1, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->efToDictionary()
        );

        AssertEquals::applyWith(
            ["content" => "Hi!"],
            "array",
            0.2, // 0.14, // 0.13, // 0.12, // 0.11, // 0.95,
            5
        )->unfoldUsing(
            Shooped::fold("Hi!")->efToDictionary()
        );

        AssertEquals::applyWith(
            ["a" => 1, "c" => 3],
            "array",
            0.41, // 0.35,
            18 // 16
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->efToDictionary()
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     *
     * Strict type checking is used
     */
    public function has()
    {
        // AssertEquals::applyWith(
        //     // if no 0 - [true, false]
        //     false,
        //     "boolean",
        //     12.66,
        //     67
        // )->unfoldUsing(
        //     Shooped::fold(true)->has(1)
        // );

        // AssertEquals::applyWith(
        //     true,
        //     "boolean",
        //     1.67
        // )->unfoldUsing(
        //     Shooped::fold(3)->has(3)
        // );

        AssertEquals::applyWith(
            true,
            "boolean",
            5.68, // 2.67,
            228 // 227
        )->unfoldUsing(
            Shooped::fold(2.5)->has(2)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.18, // 0.13, // 0.12, // 0.07, // 0.06, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->has(3.0)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.35, // 0.13,
            2
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->has(3)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.18, // 0.13, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->has(5)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            1.49, // 0.56, // 0.12,
            4
        )->unfoldUsing(
            Shooped::fold("Hi!")->has("!")
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.59,
            33
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->has(false)
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function efHas()
    {
        // AssertEquals::applyWith(
        //     // if no 0 - [true, false]
        //     false,
        //     "boolean",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(true)->efHas(1)
        // );

        // AssertEquals::applyWith(
        //     true,
        //     "boolean",
        //     0.53
        // )->unfoldUsing(
        //     Shooped::fold(3)->efHas(3)
        // );

        AssertEquals::applyWith(
            true,
            "boolean",
            2.97, // 2.73,
            228
        )->unfoldUsing(
            Shooped::fold(2.5)->efHas(2)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.24, // 0.07, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->efHas(3.0)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            6.82, // 0.21, // 0.13, // 0.09,
            1
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->efHas(3)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.3, // 0.14, // 0.07, // 0.04, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->efHas(5)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            1.64, // 0.54, // 0.15, // 0.1,
            4
        )->unfoldUsing(
            Shooped::fold("Hi!")->efHas("!")
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            2.33, // 0.55, // 0.46,
            33
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->efHas(false)
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function hasAt()
    {
        // AssertEquals::applyWith(
        //     true,
        //     "boolean",
        //     3.38, // 3.35 // 3.03
        //     81 // 79 // 16 // 15
        // )->unfoldUsing(
        //     Shooped::fold(true)->hasAt(1)
        // );

        // AssertEquals::applyWith(
        //     false,
        //     "boolean",
        //     1.5 // 1.16 // 0.92 // 0.9 // 0.59 // 0.52 // 0.51 // 0.5 // 0.48
        // )->unfoldUsing(
        //     Shooped::fold(3)->hasAt(4)
        // );

        AssertEquals::applyWith(
            true,
            "boolean",
            16.14,
            239 // 238
        )->unfoldUsing(
            Shooped::fold(2.5)->hasAt(2)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            1.82, // 0.79,
            16 // 6
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->hasAt(4)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            1.64, // 0.94, // 0.03,
            17
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->hasAt("c")
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.19, // 0.16, // 0.13, // 0.12, // 0.11,
            4
        )->unfoldUsing(
            Shooped::fold("Hi!")->hasAt(2)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            1.65, // 0.31, // 0.3,
            11
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->hasAt("b")
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function offsetExists()
    {
        // AssertEquals::applyWith(
        //     true,
        //     "boolean",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(true)->offsetExists(1)
        // );

        AssertEquals::applyWith(
            true,
            "boolean",
            12.57,
            239
        )->unfoldUsing(
            Shooped::fold(3)->offsetExists(3)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.2, // 0.15, // 0.09, // 0.07, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(2.5)->offsetExists(3)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            1.58,
            16
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->offsetExists(2)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.95,
            17
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->offsetExists("d")
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.33, // 0.21, // 0.17, // 0.15, // 0.13,
            4
        )->unfoldUsing(
            Shooped::fold("Hi!")->offsetExists(4)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.55, // 0.33, // 0.15, // 0.11, // 0.1, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold("Hi!")->offsetExists(0)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            1.61,
            11
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->offsetExists("a")
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function _at()
    {
        // AssertEquals::applyWith(
        //     1,
        //     "integer",
        //     5.23, // 3.42, // 2.95, // 2.93, // 2.76, // 2.53,
        //     242 // 223
        // )->unfoldUsing(
        //     Shooped::fold([3, 1, 3])->at(1)
        // );

        // AssertEquals::applyWith(
        //     3,
        //     "integer",
        //     0.03,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->at("b")
        // );

        // AssertEquals::applyWith(
        //     "H",
        //     "string",
        //     0.2,
        //     6
        // )->unfoldUsing(
        //     Shooped::fold("Hi!")->at(0)
        // );

        AssertEquals::applyWith(
            1,
            "integer",
            2.99,
            257
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->at("a")
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function first()
    {
        AssertEquals::applyWith(
            3,
            "integer",
            3.48, // 3.47, // 3.32, // 3.1, // 2.99,
            368
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->first(1)
        );

        AssertEquals::applyWith(
            ["a" => 1, "b" => 3],
            "array",
            0.09, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->first(2)
        );

        AssertEquals::applyWith(
            "Hi",
            "string",
            0.1, // 0.08,
            2
        )->unfoldUsing(
            Shooped::fold("Hi!")->first(2)
        );

        // AssertEquals::applyWith(
        //     (object) ["a" => 1],
        //     "object",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold((object) ["a" => 1, "c" => 3])->first()
        // );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function last()
    {
        AssertEquals::applyWith(
            3,
            "integer",
            3.67,
            377
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->last()
        );

        AssertEquals::applyWith(
            ["b" => 3, "c" => 1],
            "array",
            0.09, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->last(2)
        );

        AssertEquals::applyWith(
            "!",
            "string",
            0.11,
            2
        )->unfoldUsing(
            Shooped::fold("Hi!")->last()
        );

        // AssertEquals::applyWith(
        //     1,
        //     "integer",
        //     2.99,
        //     257
        // )->unfoldUsing(
        //     Shooped::fold((object) ["a" => 1, "c" => 3])->at("a")
        // );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function offsetGet()
    {
        // AssertEquals::applyWith(
        //     true,
        //     "boolean",
        //     3.51
        // )->unfoldUsing(
        //     Shooped::fold(true)->offsetGet(1)
        // );

        // AssertEquals::applyWith(
        //     3,
        //     "integer",
        //     0.38 // 0.35 // 0.34 // 0.32
        // )->unfoldUsing(
        //     Shooped::fold(3)->offsetGet(3)
        // );

        // AssertEquals::applyWith(
        //     2.0,
        //     "double",
        //     0.41 // 0.31
        // )->unfoldUsing(
        //     Shooped::fold(2.5)->offsetGet([2, 3])
        // );

        // AssertEquals::applyWith(
        //     [1.0, 2.0],
        //     "array",
        //     0.64 // 0.51 // 0.36
        // )->unfoldUsing(
        //     Shooped::fold(2.5)->offsetGet([1, 2, 3])
        // );

        AssertEquals::applyWith(
            1,
            "integer",
            2.91,
            223
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->offsetGet(1)
        );

        AssertEquals::applyWith(
            3,
            "integer",
            0.13, // 0.07, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "b" => 3, "c" => 1])->offsetGet("b")
        );

        AssertEquals::applyWith(
            "H",
            "string",
            0.2, // 0.17, // 0.16,
            6
        )->unfoldUsing(
            Shooped::fold("Hi!")->offsetGet(0)
        );

        // AssertEquals::applyWith(
        //     "Hi!",
        //     "string",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold("Hi!")->offsetGet("content")
        // );

        AssertEquals::applyWith(
            1,
            "integer",
            0.46, // 0.39,
            29
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->offsetGet("a")
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function insertAt()
    {
        // AssertEquals::applyWith(
        //     true,
        //     "boolean",
        //     4.58,
        //     103 // 39
        // )->unfoldUsing(
        //     Shooped::fold(false)->insertAt(1)
        // );

        // AssertEquals::applyWith(
        //     false,
        //     "boolean"
        // )->unfoldUsing(
        //     Shooped::fold(true)->insertAt(-1)
        // );

        // AssertEquals::applyWith(
        //     6,
        //     "integer"
        // )->unfoldUsing(
        //     Shooped::fold(3)->insertAt(3)
        // );

        // AssertEquals::applyWith(
        //     3.5,
        //     "double"
        // )->unfoldUsing(
        //     Shooped::fold(2.5)->insertAt(1)
        // );

        AssertEquals::applyWith(
            [1, 3, 1, 3],
            "array",
            3.39, // 3.24, // 3.07, // 2.88, // 2.79,
            254 // 253
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->insertAt(1, -1)
        );

        // AssertEquals::applyWith(
        //     [1, 1, 3],
        //     "array",
        //     3.42 // 3.26
        // )->unfoldUsing(
        //     Shooped::fold([3, 1, 3])->insertAt(1, 0)
        // );

        // AssertEquals::applyWith(
        //     [1, 1, 3],
        //     "array",
        //     1.19
        // )->unfoldUsing(
        //     Shooped::fold([3, 1, 3])->insertAt(1, 0)
        // );

        // AssertEquals::applyWith(
        //     ["a" => 1, "c" => 3, "b" => 2],
        //     "array",
        //     1.88
        // )->unfoldUsing(
        //     Shooped::fold(["a" => 1, "c" => 3])->insertAt(2, "b")
        // );

        AssertEquals::applyWith(
            "Hi!",
            "string",
            1.22, // 0.39, // 0.31,
            21
        )->unfoldUsing(
            Shooped::fold("!")->insertAt("Hi", -1)
        );

        AssertEquals::applyWith(
            "Ho!",
            "string",
            0.46, // 0.4, // 0.3, // 0.23, // 0.22, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold("Hi!")->insertAt("o", 1)
        );

        AssertEquals::applyWith(
            (object) ["a" => 2, "c" => 3],
            "object",
            1.24,
            29
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->insertAt(2, "a")
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function offsetSet()
    {
        // Returns void, uses PlusAt - TODO: maybe use different testing method
        $this->assertTrue(true);
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
   public function dropAt()
    {
        // AssertEquals::applyWith(
        //     true,
        //     "boolean",
        //     3.46,
        //     77 // 13
        // )->unfoldUsing(
        //     Shooped::fold(false)->dropAt(1)
        // );

        // AssertEquals::applyWith(
        //     false,
        //     "boolean",
        //     0.58, // 0.41 // 0.35 // 0.33
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(true)->dropAt("true")
        // );

        // AssertEquals::applyWith(
        //     false,
        //     "boolean",
        //     0.76, // 0.42 // 0.34 // 0.33
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(false)->dropAt(0)
        // );

        // AssertEquals::applyWith(
        //     0,
        //     "integer",
        //     0.84, // 0.71 // 0.62
        //     88 // 24 // 19
        // )->unfoldUsing(
        //     Shooped::fold(3)->dropAt(3)
        // );

        // AssertEquals::applyWith(
        //     1.5,
        //     "double"
        // )->unfoldUsing(
        //     Shooped::fold(2.5)->dropAt(1)
        // );

        AssertEquals::applyWith(
            [3, 3],
            "array",
            5.25,
            258 // 257
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->dropAt(1)
        );

        AssertEquals::applyWith(
            ["a" => 1],
            "array",
            0.23, // 0.19, // 0.13, // 0.09, // 0.05,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "c" => 3])->dropAt("c")
        );


        AssertEquals::applyWith(
            "H!",
            "string",
            0.53, // 0.5 // 0.41 // 0.4 // 0.37 // 0.31
            1
        )->unfoldUsing(
            Shooped::fold("Hi!")->dropAt(1)
        );


        AssertEquals::applyWith(
            (object) ["c" => 3],
            "object",
            1.11,
            4
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->dropAt("a")
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function dropFirst()
    {
        // AssertEquals::applyWith(
        //     true,
        //     "boolean",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(false)->dropFirst(1)
        // );

        // AssertEquals::applyWith(
        //     false,
        //     "boolean",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(true)->dropFirst("true")
        // );

        // AssertEquals::applyWith(
        //     false,
        //     "boolean",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(false)->dropFirst(0)
        // );

        // AssertEquals::applyWith(
        //     0,
        //     "integer",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(3)->dropFirst(3)
        // );

        // AssertEquals::applyWith(
        //     1.5,
        //     "double",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(2.5)->dropFirst(1)
        // );

        AssertEquals::applyWith(
            [3],
            "array",
            6.28, // 3.4,
            277
        )->unfoldUsing(
            Shooped::fold([3, 1, 3])->dropFirst(2)
        );

        AssertEquals::applyWith(
            ["c" => 3],
            "array",
            0.17, // 0.16, // 0.15, // 0.12, // 0.08, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "c" => 3])->dropFirst()
        );

        AssertEquals::applyWith(
            "!",
            "string",
            0.37, // 0.23, // 0.19, // 0.18, // 0.16,
            64 // 6
        )->unfoldUsing(
            Shooped::fold("Hi!")->dropFirst(2)
        );

        AssertEquals::applyWith(
            (object) ["c" => 3],
            "object",
            0.84, // 0.79,
            117
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->dropFirst()
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function dropLast()
    {
        // AssertEquals::applyWith(
        //     true,
        //     "boolean",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(false)->dropLast(1)
        // );

        // AssertEquals::applyWith(
        //     false,
        //     "boolean",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(true)->dropLast("true")
        // );

        // AssertEquals::applyWith(
        //     false,
        //     "boolean",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(false)->dropLast(0)
        // );

        // AssertEquals::applyWith(
        //     0,
        //     "integer",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(3)->dropLast(3)
        // );

        // AssertEquals::applyWith(
        //     1.5,
        //     "double",
        //     0.001,
        //     1
        // )->unfoldUsing(
        //     Shooped::fold(2.5)->dropLast(1)
        // );

        AssertEquals::applyWith(
            [3, 1],
            "array",
            3.61, // 3.39,
            264
        )->unfoldUsing(
            Shooped::fold([3, 1, 2])->dropLast()
        );

        AssertEquals::applyWith(
            [],
            "array",
            0.19, // 0.12, // 0.08, // 0.03,
            1
        )->unfoldUsing(
            Shooped::fold(["a" => 1, "c" => 3])->dropLast(2)
        );

        AssertEquals::applyWith(
            "H",
            "string",
            3.39, // 3.37, // 3.16,
            270
        )->unfoldUsing(
            Shooped::fold("Hi!")->dropLast(2)
        );

        AssertEquals::applyWith(
            (object) ["a" => 1],
            "object",
            2.14,
            53
        )->unfoldUsing(
            Shooped::fold((object) ["a" => 1, "c" => 3])->dropLast()
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function offsetUnset()
    {
        // Returns void, uses PlusAt - TODO: maybe use different testing method
        $this->assertTrue(true);
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function each()
    {
        AssertEquals::applyWith(
            [2, 3, 4],
            "array",
            6.27, // 2.9,
            238 // 237 // 236 // 235
        )->unfoldUsing(
            Shoop::this([1, 2, 3])->each(function($v) {
                return $v + 1;
            })
        );

        AssertEquals::applyWith(
            ["a" => "2a", "b" => "3b"],
            "array",
            0.17, // 0.13, // 0.07, // 0.03,
            1
        )->unfoldUsing(
            Shoop::this(["a" => 1, "b" => 2])->each(function($v, $m) {
                return $v + 1 . $m;
            })
        );

        AssertEquals::applyWith(
            ["a2" => 2, "b3" => 3],
            "array",
            0.17,
            1
        )->unfoldUsing(
            Shoop::this(["a" => 1, "b" => 2])->each(function($v, $m, &$build) {
                $v = $v + 1;
                $m = $m . $v;
                $build[$m] = $v;
            })
        );

        AssertEquals::applyWith(
            "8fold",
            "string",
            0.19, // 0.16,
            6
        )->unfoldUsing(
            Shoop::this("8fold!")->each(function(
                $v,
                $m,
                &$build,
                &$break
            ) {
                if ($v === "!") {
                    $break = true;

                } else {
                    $build[$m] = $v;

                }
            })
        );

        // TODO: Objects
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function retain()
    {
        AssertEquals::applyWith(
            [1, 3],
            "array",
            5.25,
            258 // 257
        )->unfoldUsing(
            Shoop::this([1, null, 3])->retain("is_int")
        );

        AssertEquals::applyWith(
            [],
            "array",
            0.14, // 0.12, // 0.11, // 0.1, // 0.08, // 0.05,
            1
        )->unfoldUsing(
            Shoop::this(["a" => 1, "b" => 2])->retain(function($v, $m) {
                return $m === "c";
            })
        );

        AssertEquals::applyWith(
            ["b" => 2],
            "array",
            0.11, // 0.1, // 0.08, // 0.03,
            1
        )->unfoldUsing(
            Shoop::this(["a" => 1, "b" => 2])->retain(function($v, $m) {
                return $m === "b";
            })
        );

        AssertEquals::applyWith(
            "8",
            "string",
            0.19, // 0.15, // 0.14, // 0.13,
            4
        )->unfoldUsing(
            Shoop::this("8fold!")->retain(function($v) {
                return $v === "8";
            })
        );
    }

    /**
     * @test
     * @group 1.0.0
     * @group Associable
     */
    public function drop()
    {
        AssertEquals::applyWith(
            [null],
            "array",
            4.27, // 3.47,
            270
        )->unfoldUsing(
            Shoop::this([1, null, 3])->drop("is_int")
        );

        AssertEquals::applyWith(
            [],
            "array",
            0.27, // 0.16, // 0.12, // 0.11, // 0.1, // 0.06, // 0.05, // 0.04,
            1
        )->unfoldUsing(
            Shoop::this(["a" => 1, "b" => 2])->drop(function($v, $m) {
                return is_string($m);
            })
        );

        AssertEquals::applyWith(
            ["a" => 1],
            "array",
            0.15, // 0.1, // 0.08, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            Shoop::this(["a" => 1, "b" => 2])->drop(function($v, $m) {
                return $m === "b";
            })
        );

        AssertEquals::applyWith(
            "fold!",
            "string",
            1.63, // 0.27, // 0.19, // 0.15,
            4
        )->unfoldUsing(
            Shoop::this("8fold!")->drop(function($v) {
                return $v === "8";
            })
        );
    }
}
