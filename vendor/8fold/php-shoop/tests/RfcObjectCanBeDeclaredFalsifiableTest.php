<?php

namespace Eightfold\Shoop\Tests\PipeFilters;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Shooped;

use Eightfold\Shoop\FilterContracts\Interfaces\Falsifiable;
use Eightfold\Shoop\FilterContracts\Interfaces\Emptiable;

use Eightfold\Shoop\Filter\TypeJuggling\AsBoolean;
use Eightfold\Shoop\Filter\Is\IsEmpty;

/**
 * @group AsBoolean
 * @group IsEmpty
 * @group 1.0.0
 *
 * In Php, a valid object instance is always `true` and never `empty`. There
 * is no mechanism as of PHP 8.0 for an `object` type to be false; instead,
 * the `null` type is used as a placeholder.
 *
 * In Shoop, we say `null` doesn't exist; rather than it representing
 * being something representing nothing. Therefore, in Shoop, an object
 * follows patterns established for `dictionary` in that if a `dictionary` has
 * members, it is true and is not empty. Further, Shoop objects have the
 * ability to say whether they are true or false.
 *
 * The first two characters of the method name are placeholders for a possible
 * future magic method proprosed in PHP RFC: Objects can be declared
 * falsifiable. The `Falsifiable` interface can be found in
 * `/src/FilterContracts/Interfaces/Falsifiable.php`. The Shoop check and response
 * can be found in `/src/Filter/TypeJuggling/AsBoolean.php`.
 *
 * The former would be similar to the interface added to PHP. The latter could be
 * similar to the check and work performed by PHP when a `boolean` type is assumed,
 * including within conditionals.
 *
 * @see https://wiki.php.net/rfc/objects-can-be-falsifiable
 */
class RfcObjectCanBeDeclaredFalsifiableTest extends TestCase
{
    /**
     * @test
     */
    public function empty_instance_is_false_and_empty()
    {
        $using = new class {};

        // PHP - true|false
        $bool = (bool) $using;
        $empty = empty($using);

        $this->assertTrue($bool);
        $this->assertFalse($empty);

        // Shoop (deviation) - false|true
        AssertEquals::applyWith(
            false,
            "boolean",
            4.03, // 2.89, // 0.94, // 0.88, // 0.75 // 0.43
            107 // 43 // 42
        )->unfoldUsing(
            AsBoolean::apply() // Represents the PHP boolean responder script.
                ->unfoldUsing($using)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            0.71,
            17
        )->unfoldUsing(
            IsEmpty::apply()->unfoldUsing($using)
        );
    }

    /**
     * @test
     */
    public function instance_with_public_property_matches_php()
    {
        $using = new class {
            public $property = "8fold";
        };

        // PHP - true|false
        $bool  = (bool) $using;
        $empty = empty($using);

        $this->assertTrue($bool);
        $this->assertFalse($empty);

        // Shoop - true|false
        AssertEquals::applyWith(
            true,
            "boolean",
            0.65, // 0.45,
            1
        )->unfoldUsing(
            AsBoolean::apply()->unfoldUsing($using)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            0.43,
            17
        )->unfoldUsing(
            IsEmpty::apply()->unfoldUsing($using)
        );
    }

    /**
     * @test
     */
    public function falsifiable_instance_can_be_false_and_non_empty()
    {
        $using = new class implements Falsifiable {
            public $property = "8fold";

            // Not required or desired for RFC purposes.
            public function asBoolean(): Falsifiable
            {
                return Shooped::fold(false);
            }

            // Would become "__toBool" to match PHP magic method and type
            // reference pattern of truncating "boolean" to "bool," despite
            // gettype() returning "boolean".
            public function efToBoolean(): bool
            {
                return $this->asBoolean()->unfold();
            }
        };

        // PHP - true|false
        $bool  = (bool) $using;
        $empty = empty($using);

        $this->assertTrue($bool);
        $this->assertFalse($empty);

        // Shoop (deviation) - false|false
        AssertEquals::applyWith(
            false,
            "boolean",
            6.13, // 5.89, // 5.37, // 1.58 // 1.09
            121
        )->unfoldUsing(
            AsBoolean::apply()->unfoldUsing($using)
        );

        AssertEquals::applyWith(
            false,
            "boolean",
            1.74, // 0.79, // 0.73,
            35
        )->unfoldUsing(
            IsEmpty::apply()->unfoldUsing($using)
        );
    }

    /**
     * Not related to RFC as submitted; however, is related given the coupling
     * between falsiness and emptiness in PHP.
     *
     * @test
     */
    public function emptiable_instance_can_be_empty_despite_public_properties()
    {
        $using = new class implements Emptiable {
            public $property = "8fold";

            public function isEmpty(): Emptiable
            {
                return Shooped::fold(true);
            }

            public function efIsEmpty(): bool
            {
                return $this->isEmpty()->unfold();
            }
        };

        // PHP - true|false
        $bool  = (bool) $using;
        $empty = empty($using);

        $this->assertTrue($bool);
        $this->assertFalse($empty);

        // Shoop (deviation) - false|true
        AssertEquals::applyWith(
            false,
            "boolean",
            0.31,
            1
        )->unfoldUsing(
            AsBoolean::apply()->unfoldUsing($using)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            1.14, // 1.05 // 1.02
            1
        )->unfoldUsing(
            IsEmpty::apply()->unfoldUsing($using)
        );
    }

    /**
     * Not related to RFC as submitted; however, is related given the coupling
     * between falsiness and emptiness in PHP.
     *
     * @test
     */
    public function instance_can_specify_emptiness_and_falsiness_achieving_false_and_empty()
    {
        $using = new class implements Falsifiable, Emptiable {
            public $property = "8fold";

            public function asBoolean(): Falsifiable
            {
                return Shooped::fold(false);
            }

            public function efToBoolean(): bool
            {
                return $this->asBoolean()->unfold();
            }

            public function isEmpty(): Emptiable
            {
                return Shooped::fold(true);
            }

            public function efIsEmpty(): bool
            {
                return $this->isEmpty()->unfold();
            }
        };

        // PHP - true|false
        $bool  = (bool) $using;
        $empty = empty($using);

        $this->assertTrue($bool);
        $this->assertFalse($empty);

        // Shoop (deviation) - false|true
        AssertEquals::applyWith(
            false,
            "boolean",
            1, // 0.41 // 0.32
            64
        )->unfoldUsing(
            AsBoolean::apply()->unfoldUsing($using)
        );

        AssertEquals::applyWith(
            true,
            "boolean",
            1.16,
            1
        )->unfoldUsing(
            IsEmpty::apply()->unfoldUsing($using)
        );
    }
}
