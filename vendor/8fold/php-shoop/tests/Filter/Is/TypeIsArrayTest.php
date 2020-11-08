<?php

namespace Eightfold\Shoop\Tests\Filter\Is;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Filter\Is\IsArray;

/**
 * @group TypeChecking
 *
 * @group  IsArray
 */
class TypeIsArrayTest extends TestCase
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
            6.97, // 1.93, // 1.68, // 1.52, // 1.2, // 1.11, // 0.94, // 0.91, // 0.68, // 0.01,
            148 // 145 // 126 // 123 // 113 // 111 // 109 // 108
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing([1, 2, 3])
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
            0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing(1)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.04, // 0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing(1.0)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing(1.1)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.4, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing(true)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.02, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing(false)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.44, // 0.36,
            14
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing("")
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing("hello")
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.05, // 0.04, // 0.03, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing([])
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.94, // 0.91, // 0.68, // 0.01,
            108
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing([2 => 1, 3 => 2, 4 => 3])
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.06, // 0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing(["a" => 1, "b" => 2, "c" => 3])
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing(new stdClass)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.04, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing(new class {
                public $hello = "world";
            })
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing('{}')
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.22, // 0.07, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing(new class {
                private $hello = "world";
            })
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.06, // 0.01,
            1
        )->unfoldUsing(
            IsArray::apply()->unfoldUsing(
                new class {
                    public function test(): void
                    {}
                }
            )
        );
    }
}
