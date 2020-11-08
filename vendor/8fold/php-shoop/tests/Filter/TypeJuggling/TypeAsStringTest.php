<?php

namespace Eightfold\Shoop\Tests\Filter\TypeJuggling;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\Filter\TypeJuggling\AsString;

use Eightfold\Shoop\FilterContracts\Interfaces\Stringable;

/**
 * @group TypeChecking
 *
 * @group  AsString
 *
 * @group 1.0.0
 */
class TypeAsStringTest extends TestCase
{
    /**
     * @test
     */
    public function boolean()
    {
        AssertEquals::applyWith(
            "true",
            "string",
            1.16,
            19
        )->unfoldUsing(
            AsString::fromBoolean(true)
        );

        AssertEquals::applyWith(
            "false",
            "string",
            0.02, // 0.005, // 0.004, // 0.003, // 0.002,
            1
        )->unfoldUsing(
            AsString::fromBoolean(false)
        );
    }

    /**
     * @test
     */
    public function strings()
    {
        AssertEquals::applyWith(
            "",
            "string",
            1.29, // 1.11,
            79 // 50 // 31
        )->unfoldUsing(
            AsString::fromString("")
        );

        AssertEquals::applyWith(
            "8fold!",
            "string",
            0.04, // 0.02, // 0.01, // 0.005, // 0.004, // 0.003,
            1
        )->unfoldUsing(
            AsString::fromString("8fold!")
        );

        AssertEquals::applyWith(
            "8!f!o!l!d!!",
            "string",
            0.03, // 0.01, // 0.004, // 0.003,
            1
        )->unfoldUsing(
            AsString::fromString("8fold!", "!")
        );
    }

    /**
     * @test
     */
    public function collections()
    {
        AssertEquals::applyWith(
            "",
            "string",
            4.07, // 3.38, // 3.2, // 2.88,
            228
        )->unfoldUsing(
            AsString::fromJson('{"member":false}')
        );

        AssertEquals::applyWith(
            "hello",
            "string",
            0.39, // 0.19, // 0.17, // 0.05,
            1
        )->unfoldUsing(
            AsString::fromTuple('{"member":"hello"}')
        );

        AssertEquals::applyWith(
            "hello, world!",
            "string",
            0.88, // 0.3, // 0.29, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            AsString::fromTuple('{"a":"hello","b":", ","c":"world!"}')
        );
    }

    /**
     * @test
     */
    public function objects()
    {
        AssertEquals::applyWith(
            "",
            "string",
            2.41, // 2.27, // 2.25, // 2.2,
            180
        )->unfoldUsing(
            AsString::fromObject(
                new class {}
            )
        );

        AssertEquals::applyWith(
            "hello, world!",
            "string",
            0.25, // 0.2, // 0.17, // 0.15, // 0.14, // 0.12, // 0.1, // 0.05, // 0.04,
            1
        )->unfoldUsing(
            AsString::fromObject(
                new class {
                    public $a = "hello";
                    public $b = ", ";
                    public $c = "world!";
                    private $private = "private";
                    public function someAction()
                    {
                        return false;
                    }
                }
            )
        );

        AssertEquals::applyWith(
            "hello",
            "string",
            1.25,
            61
        )->unfoldUsing(
            AsString::fromObject(
                new class implements Stringable {
                    public $public = "content";
                    private $private = "private";

                    public function asString(string $glue = ""): Stringable
                    {
                        return Shoop::this("hello");
                    }

                    public function efToString(string $glue = ""): string
                    {
                        return $this->asString($glue)->unfold();
                    }

                    public function __toString(): string
                    {
                        return $this->efToString();
                    }
                }
            )
        );
    }
}
