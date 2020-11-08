<?php

namespace Eightfold\Shoop\Tests\Filter\Is;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Filter\Is\IsList;

/**
 * @group TypeChecking
 *
 * @group IsList
 * @group 1.0.0
 */
class TypeIsListTest extends TestCase
{
    /**
     * @test
     */
    public function valid()
    {
        $expected = true;

       AssertEquals::applyWith(
            $expected,
            "boolean",
            1.09,
            9
        )->unfoldUsing(
            IsList::apply()->unfoldUsing([])
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.06, // 0.04, // 0.01, // 0.003,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing([1, 2, 3])
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.01, // 0.002,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing(["a" => 1, "b" => 2, "c" => 3])
        );
    }

    /**
     * @test
     */
    public function invalid()
    {
        $expected = false;

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.01, // 0.004,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing(1)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.21, // 0.01, // 0.002,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing(1.0)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.01, // 0.001,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing(1.1)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.01, // 0.001,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing(true)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.01, // 0.001,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing(false)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.01, // 0.005, // 0.001,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing("")
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.01, // 0.002,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing("hello")
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.02, // 0.01, // 0.002,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing(new stdClass)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.01, // 0.002,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing(new class {
                public $hello = "world";
            })
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.01, // 0.001,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing('{}')
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.02, // 0.01, // 0.002,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing(new class {
                private $hello = "world";
            })
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.02, // 0.01, // 0.002,
            1
        )->unfoldUsing(
            IsList::apply()->unfoldUsing(
                new class {
                    public function test(): void
                    {}
                }
            )
        );
    }
}
