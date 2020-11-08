<?php

namespace Eightfold\Shoop\Tests\Filter\TypeJuggling;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\Filter\TypeJuggling\AsNumber;

use Eightfold\Shoop\FilterContracts\Interfaces\Countable;

/**
 * @group TypeChecking
 *
 * @group  AsNumber
 *
 * @group 1.0.0
 */
class TypeAsNumberTest extends TestCase
{
    /**
     * @test
     */
    public function boolean()
    {
        AssertEquals::applyWith(
            1,
            "integer",
            1.74, // 1.28, // 0.94, // 79, // 0.7, // 0.47,
            81 // 79 // 75 // 21
        )->unfoldUsing(
            AsNumber::fromBoolean(true)
        );

        AssertEquals::applyWith(
            0,
            "integer",
            0.03, // 0.01, // 0.004, // 0.003, // 0.002,
            1
        )->unfoldUsing(
            AsNumber::fromBoolean(false)
        );
    }

    /**
     * @test
     */
    public function numbers()
    {
        AssertEquals::applyWith(
            1,
            "integer",
            2.81, // 2.14, // 0.75,
            79 // 41 // 28
        )->unfoldUsing(
            AsNumber::fromNumber(1)
        );

        AssertEquals::applyWith(
            0,
            "integer",
            0.18, // 0.13, // 0.09,
            67 // 3
        )->unfoldUsing(
            AsNumber::fromNumber(0.0)
        );

        AssertEquals::applyWith(
            1.1,
            "double",
            0.04, // 0.03, // 0.02, // 0.004, // 0.003,
            1
        )->unfoldUsing(
            AsNumber::fromNumber(1.1)
        );
    }

    /**
     * @test
     */
    public function strings()
    {
        AssertEquals::applyWith(
            0,
            "integer",
            1.66,
            73 // 72 // 23
        )->unfoldUsing(
            AsNumber::fromString("")
        );

        AssertEquals::applyWith(
            8,
            "integer",
            0.08, // 0.01,
            1
        )->unfoldUsing(
            AsNumber::fromString("8fold!")
        );

        AssertEquals::applyWith(
            8.0,
            "double",
            0.03, // 0.01, // 0.005, // 0.004,
            1
        )->unfoldUsing(
            AsNumber::fromString("8fold.")
        );
    }

    /**
     * @test
     */
    public function lists()
    {
        AssertEquals::applyWith(
            0,
            "integer",
            1.01,
            20
        )->unfoldUsing(
            AsNumber::fromList([])
        );

        AssertEquals::applyWith(
            1,
            "integer",
            0.03, // 0.004, // 0.002,
            1
        )->unfoldUsing(
            AsNumber::fromList(["a" => 1, "b" => 2, "c" => 3])
        );
    }

    /**
     * @test
     */
    public function objects()
    {
        AssertEquals::applyWith(
            0,
            "integer",
            11.16, // 7.9,
            184
        )->unfoldUsing(
            AsNumber::fromObject(
                new class {}
            )
        );

        AssertEquals::applyWith(
            1,
            "integer",
            0.22, // 0.2, // 0.09, // 0.05, // 0.04,
            1
        )->unfoldUsing(
            AsNumber::fromObject(
                new class {
                    public $public = "content";
                    private $private = "private";
                }
            )
        );

        AssertEquals::applyWith(
            1,
            "integer",
            0.22, // 0.11, // 0.03,
            1
        )->unfoldUsing(
            AsNumber::fromObject(
                new class {
                    public $public = "content";
                    private $private = "private";
                    public function someAction()
                    {
                        return false;
                    }
                }
            )
        );

        AssertEquals::applyWith(
            10,
            "integer",
            9.32, // 7.53,
            61
        )->unfoldUsing(
            AsNumber::fromObject(
                new class implements Countable {
                    public $public = "content";
                    private $private = "private";
                    public function asInteger(): Countable
                    {
                        return Shoop::this(10);
                    }

                    public function efToInteger(): int
                    {
                        return $this->asInteger()->unfold();
                    }

                    public function length(): Countable
                    {
                        return Shoop::this(
                            Apply::count()->unfoldUsing(10)
                        );
                    }

                    public function count(): int
                    {
                        return $this->length()->unfold();
                    }
                }
            )
        );
    }
}
