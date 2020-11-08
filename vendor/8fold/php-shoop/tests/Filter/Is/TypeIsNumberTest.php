<?php

namespace Eightfold\Shoop\Tests\Filter\Is;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Filter\Is\IsNumber;

/**
 * @group TypeChecking
 *
 * @group  IsNumber
 */
class TypeIsNumberTest extends TestCase
{
    /**
     * @test
     */
    public function valid()
    {

        AssertEquals::applyWith(
            true,
            "boolean",
            2.07, // 0.38,
            66 // 11 // 9
        )->unfoldUsing(
            IsNumber::apply()->unfoldUsing(1)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.96,
            1
        )->unfoldUsing(
            IsNumber::apply()->unfoldUsing(1.0)
        );

    }

    /**
     * @test
     */
    public function invalid()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsNumber::apply()->unfoldUsing(true)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.1, // 0.01,
            1
        )->unfoldUsing(
            IsNumber::apply()->unfoldUsing(false)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.03, // 0.01,
            1
        )->unfoldUsing(
            IsNumber::apply()->unfoldUsing("")
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.06, // 0.03, // 0.01,
            1
        )->unfoldUsing(
            IsNumber::apply()->unfoldUsing([])
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.03, // 0.01,
            1
        )->unfoldUsing(
            IsNumber::apply()->unfoldUsing(new stdClass)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.01,
            1
        )->unfoldUsing(
            IsNumber::apply()->unfoldUsing('{}')
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsNumber::apply()->unfoldUsing(
                new class {
                    public function test(): void
                    {}
                }
            )
        );
    }
}
