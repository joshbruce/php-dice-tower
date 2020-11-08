<?php

namespace Eightfold\Shoop\Tests\Filter\Is;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Filter\Is\IsDictionary;

/**
 * @group TypeChecking
 *
 * @group  IsDictionary
 */
class TypeIsDictionaryTest extends TestCase
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
            // jumps are from adding filter use
            0.94, // 0.8, // 0.68, // 0.61, // 0.58, // 0.51, // 0.46, // 0.39, // 0.36, // 0.27,
            40 // 37 // 35 // 31 // 21 // 11
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing(["a" => 1, "b" => 2, "c" => 3])
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
            0.04, // 0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing(1)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing(1.0)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing(1.1)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.11, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing(true)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing(false)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.44, // 0.36,
            14
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing("")
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.05, // 0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing("hello")
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.1, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing([])
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.07, // 0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing([1, 2, 3])
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing(new stdClass)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing(new class {
                public $hello = "world";
            })
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing('{}')
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing(new class {
                private $hello = "world";
            })
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.02, // 0.01,
            1
        )->unfoldUsing(
            IsDictionary::apply()->unfoldUsing(
                new class {
                    public function test(): void
                    {}
                }
            )
        );
    }
}
