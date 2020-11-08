<?php

namespace Eightfold\Shoop\Tests\Filter\Is;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Filter\Is\IsBoolean;

/**
 * @group TypeChecking
 *
 * @group  IsBoolean
 */
class TypeIsBooleanTest extends TestCase
{
    /**
     * @test
     */
    public function valid()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            0.71,
            9
        )->unfoldUsing(
            IsBoolean::apply()->unfoldUsing(true)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.11, // 0.03, // 0.01,
            1
        )->unfoldUsing(
            IsBoolean::apply()->unfoldUsing(false)
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
            0.03, // 0.01,
            1
        )->unfoldUsing(
            IsBoolean::apply()->unfoldUsing(1)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.01,
            1
        )->unfoldUsing(
            IsBoolean::apply()->unfoldUsing(1.0)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.03, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsBoolean::apply()->unfoldUsing("")
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.03, // 0.01,
            1
        )->unfoldUsing(
            IsBoolean::apply()->unfoldUsing([])
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.03, // 0.01,
            1
        )->unfoldUsing(
            IsBoolean::apply()->unfoldUsing(new stdClass)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.03, // 0.01,
            1
        )->unfoldUsing(
            IsBoolean::apply()->unfoldUsing('{}')
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.02, // 0.01,
            1
        )->unfoldUsing(
            IsBoolean::apply()->unfoldUsing(
                new class {
                    public function test(): void
                    {}
                }
            )
        );
    }
}
