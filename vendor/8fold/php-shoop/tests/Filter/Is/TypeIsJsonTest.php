<?php

namespace Eightfold\Shoop\Tests\Filter\Is;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Filter\Is\IsJson;

/**
 * @group TypeChecking
 *
 * @group  IsJson
 */
class TypeIsJsonTest extends TestCase
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
            2.14,
            109
        )->unfoldUsing(
            IsJson::apply()->unfoldUsing('{}')
        );

        AssertEquals::applyWith(
            $expected,
            "boolean",
            0.06, // 0.05, // 0.01,
            1
        )->unfoldUsing(
            IsJson::apply()->unfoldUsing('{"@type":"Thing"}')
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
            0.04, // 0.01,
            1
        )->unfoldUsing(
            IsJson::apply()->unfoldUsing("Hello")
        );
    }
}
