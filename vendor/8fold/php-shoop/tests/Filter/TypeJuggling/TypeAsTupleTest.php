<?php

namespace Eightfold\Shoop\Tests\Filter\TypeJuggling;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\Filter\TypeJuggling\AsTuple;

use Eightfold\Shoop\FilterContracts\Interfaces\Stringable;

/**
 * @group TypeChecking
 *
 * @group AsTuple
 *
 * @group 1.0.0
 */
class TypeAsTupleTest extends TestCase
{
    /**
     * @test
     */
    public function boolean()
    {
        $true = new stdClass;
        $true->false = false;
        $true->true  = true;

        AssertEquals::applyWith(
            $true,
            "object",
            0.84, // 0.8, // 0.74,
            105, // 104
        )->unfoldUsing(
            AsTuple::fromBoolean(true)
        );

        $false = new stdClass;
        $false->false = true;
        $false->true  = false;

        AssertEquals::applyWith(
            $false,
            "object",
            0.13, // 0.07, // 0.05, // 0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            AsTuple::fromBoolean(false)
        );
    }

    /**
     * @test
     */
    public function numbers()
    {
        $int = new stdClass;
        $int->{"0.0"} = 2;

        AssertEquals::applyWith(
            $int,
            "object",
            0.98,
            126
        )->unfoldUsing(
            AsTuple::fromNumber(2)
        );

        $float = new stdClass;
        $float->{"0.0"} = 1.2;

        AssertEquals::applyWith(
            $float,
            "object",
            0.09, // 0.08, // 0.07, // 0.06, // 0.05, // 0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            AsTuple::fromNumber(1.2)
        );
    }

    /**
     * @test
     */
    public function strings()
    {
        $string = new stdClass;
        $string->content = "hello";

        AssertEquals::applyWith(
            $string,
            "object",
            0.97, // 0.82, // 0.7,
            105
        )->unfoldUsing(
            AsTuple::fromString("hello")
        );
    }

    /**
     * @test
     */
    public function lists()
    {
        $array = new stdClass;
        $array->{"0.0"} = 1;
        $array->{"1.0"} = 2;
        $array->{"2.0"} = 3;

        AssertEquals::applyWith(
            $array,
            "object",
            1.02, // 0.99, // 0.86, // 0.84,
            117
        )->unfoldUsing(
            AsTuple::fromList([1, 2, 3])
        );

        $dictionary = new stdClass;
        $dictionary->first = 1;
        $dictionary->second = 2;
        $dictionary->third = 3;

        AssertEquals::applyWith(
            $dictionary,
            "object",
            0.11, // 0.05, // 0.04, // 0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            AsTuple::fromList(["first" => 1, "second" => 2, "third" => 3])
        );
    }
}
