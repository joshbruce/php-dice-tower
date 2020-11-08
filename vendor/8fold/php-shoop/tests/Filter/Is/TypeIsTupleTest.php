<?php

namespace Eightfold\Shoop\Tests\Filter\Is;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Filter\Is\IsTuple;

/**
 * @group TypeChecking
 *
 * @group  IsTuple
 */
class TypeIsTupleTest extends TestCase
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
            1.38, // 1.15, // 0.41, // 0.4, // 0.39, // 0.38, // 0.37, // 0.34, // 0.33, // 0.32, // 0.27,
            13 // 12 // 11
        )->unfoldUsing(
            IsTuple::apply()->unfoldUsing(new stdClass)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            6.32, // 6.25, // 4.78, // 3.18,
            142 // 139 // 137
        )->unfoldUsing(
            IsTuple::apply()->unfoldUsing('{}')
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            1.23, // 0.5, // 0.43, // 0.32, // 0.25, // 0.19,
            32 // 16
        )->unfoldUsing(
            IsTuple::apply()->unfoldUsing(
                new class {}
            )
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
            2.12, // 1.77, // 0.51, // 0.5, // 0.49, // 0.37,
            21 // 20
        )->unfoldUsing(
            IsTuple::apply()->unfoldUsing(1)
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            3.73,
            19
        )->unfoldUsing(
            IsTuple::apply()->unfoldUsing('')
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            2.22, // 1.58, // 0.02,
            32
        )->unfoldUsing(
            IsTuple::apply()->unfoldUsing(
                new class {
                    public $constructed = false;

                    public function __construct()
                    {
                        $this->constructed = true;
                    }
                }
            )
        );
    }
}
