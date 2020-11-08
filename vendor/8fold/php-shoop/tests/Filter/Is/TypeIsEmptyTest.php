<?php

namespace Eightfold\Shoop\Tests\Filter\Is;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Filter\Is\IsEmpty;
use Eightfold\Shoop\Filter\Is\IsJson;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\FilterContracts\Interfaces\Tupleable;
use Eightfold\Shoop\FilterContracts\Interfaces\Emptiable;
use Eightfold\Shoop\FilterContracts\Interfaces\Falsifiable;

/**
 * @group TypeChecking
 *
 * @group IsEmpty
 * @group IsEmptyOnly
 * @group 1.0.0
 */
class TypeIsEmptyTest extends TestCase
{
    /**
     * @test
     */
    public function fromTuple()
    {
        $tuple = new stdClass;
        AssertEquals::applyWith(
            true,
            "boolean",
            10.8, // 9.37, // 6.9, // 6.77,
            192 // 184 // 180 // 179
        )->unfoldUsing(
            IsEmpty::fromTuple($tuple)
        );

        $tuple->property = true;
        AssertEquals::applyWith(
            false,
            "boolean",
            0.21, // 0.12, // 0.08, // 0.07, // 0.06, // 0.03, // 0.02,
            1
        )->unfoldUsing(
            IsEmpty::fromTuple($tuple)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            1.24, // 1.17, // 0.93, // 0.68, // 0.67, // 0.51, // 0.04, // 0.03, // 0.02,
            10 // 9 // 5
        )->unfoldUsing(
            IsEmpty::fromTuple(
                new class {}
            )
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.19, // 0.13, // 0.12, // 0.09, // 0.08, // 0.07, // 0.06, // 0.03,
            1
        )->unfoldUsing(
            IsEmpty::fromTuple(
                new class {
                    private $private = true;
                }
            )
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.19, // 0.18, // 0.13, // 0.08, // 0.07, // 0.06, // 0.03,
            1
        )->unfoldUsing(
            IsEmpty::fromTuple(
                new class {
                    public $public = true;
                    private $private = true;
                }
            )
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            4.76, // 2.28, // 0.67, // 0.6, // 0.59, // 0.52,
            76 // 21
        )->unfoldUsing(
            IsEmpty::fromTuple('')
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            6.18, // 4.66, // 3.6, // 0.67, // 0.64,
            96 // 54 // 42 // 40
        )->unfoldUsing(
            IsEmpty::fromTuple('{}')
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.75, // 0.06, // 0.05,
            1
        )->unfoldUsing(
            IsEmpty::fromTuple('{"member":true}')
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.1, // 0.06, // 0.04, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsEmpty::fromJson('')
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.32, // 0.3, // 0.29, // 0.25, // 0.2, // 0.19, // 0.04,
            1
        )->unfoldUsing(
            IsEmpty::fromJson('{}')
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.3, // 0.28,
            1
        )->unfoldUsing(
            IsEmpty::fromJson('{"member":true}')
        );
    }

    /**
     * @test
     */
    public function objects()
    {
        AssertEquals::applyWith(
            true,
            "boolean",
            8.76, // 8.35,
            194
        )->unfoldUsing(
            IsEmpty::fromObject(
                new class {}
            )
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            6.5,
            153
        )->unfoldUsing(
            IsEmpty::fromObject(
                new class {
                    public $public = "content";
                    private $private = "private";
                }
            )
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.29, // 0.21, // 0.18, // 0.04, // 0.03,
            1
        )->unfoldUsing(
            IsEmpty::fromObject(
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
            true,
            "boolean",
            9.84, // 9.49, // 9.17, // 7.6, // 1.74,
            142 // 141 // 138 // 129 // 128 // 124 // 61
        )->unfoldUsing(
            IsEmpty::fromObject(
                new class implements Emptiable {
                    public $public = "content";
                    private $private = "private";

                    public function isEmpty(): Emptiable
                    {
                        return Shoop::this(true);
                    }

                    public function efIsEmpty(): bool
                    {
                        return $this->isEmpty()->unfold();
                    }
                }
            )
        );
    }

    /**
     * @test
     *
     * @group IsJson
     *
     * Touches so many things, worth testing by itself.
     */
    public function isJsonSubProcess()
    {
        AssertEquals::applyWith(
            false,
            "boolean",
            2.6, // 1.16, // 0.81, // 0.7, // 0.68,
            126 // 34
        )->unfoldUsing(
            IsJson::apply()->unfoldUsing('')
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.62, // 0.32, // 0.25,
            14
        )->unfoldUsing(
            IsJson::apply()->unfoldUsing('xx')
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            3.04, // 0.46, // 0.45, // 0.42,
            31
        )->unfoldUsing(
            IsJson::apply()->unfoldUsing('{}')
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.08, // 0.07, // 0.06, // 0.05, // 0.04, // 0.02,
            1
        )->unfoldUsing(
            IsJson::apply()->unfoldUsing('{"member":"good json"}')
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.08, // 0.05, // 0.04, // 0.02, // 0.01,
            1
        )->unfoldUsing(
            IsJson::apply()->unfoldUsing('{"member":"bad json}')
        );
    }
}
