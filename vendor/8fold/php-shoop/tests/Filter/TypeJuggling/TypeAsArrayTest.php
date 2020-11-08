<?php

namespace Eightfold\Shoop\Tests\Filter\TypeJuggling;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use \stdClass;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\Filter\TypeJuggling\AsArray;

use Eightfold\Shoop\FilterContracts\Interfaces\Addable;
use Eightfold\Shoop\FilterContracts\Interfaces\Subtractable;
use Eightfold\Shoop\FilterContracts\Interfaces\Arrayable;
use Eightfold\Shoop\FilterContracts\Interfaces\Associable;
use Eightfold\Shoop\FilterContracts\Interfaces\Falsifiable;

/**
 * @group TypeChecking
 *
 * @group  AsArray
 *
 * @group 1.0.0
 */
class TypeAsArrayTest extends TestCase
{
    /**
     * @test
     */
    public function objects()
    {
        AssertEquals::applyWith(
            ["content"],
            "array",
            11.27, // 6.97, // 3.02,
            183
        )->unfoldUsing(
            AsArray::fromObject(
                new class {
                    public $public = "content";
                    private $private = "private";
                }
            )
        );

        AssertEquals::applyWith(
            ["content"],
            "array",
            0.24, // 0.18, // 0.15, // 0.14, // 0.12, // 0.09, // 0.05, // 0.04,
            1
        )->unfoldUsing(
            AsArray::fromObject(
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
            [],
            "array",
            9.66, // 1.27,
            128 // 123 // 60
        )->unfoldUsing(
            AsArray::fromObject(
                new class implements Arrayable {
                    public $public = "content";
                    private $private = "private";

                    public function plus($value): Addable
                    {
                        return Shoop::this([]);
                    }

                    public function minus($value): Subtractable
                    {
                        return Shoop::this([]);
                    }

                    public function asDictionary(): Associable
                    {
                        return Shoop::this([]);
                    }

                    public function efToDictionary(): array
                    {
                        return $this->asDictionary()->unfold();
                    }

                    public function asArray(): Arrayable
                    {
                        return Shoop::this([]);
                    }

                    public function efToArray(): array
                    {
                        return $this->asArray()->unfold();
                    }

                    public function has($member): Falsifiable
                    {
                        return Shoop::this(true);
                    }

                    public function hasAt($member): Falsifiable
                    {
                        return Shoop::this(false);
                    }

                    public function offsetExists($offset): bool
                    {
                        return $this->hasAt($offset)->unfold();
                    }

                    public function at($member)
                    {
                        return false;
                    }

                    public function first($length = 1)
                    {
                        return false;
                    }

                    public function last($length = 1)
                    {
                        return false;
                    }

                    public function offsetGet($offset)
                    {
                        return $this->at($offset)->unfold();
                    }

                    public function insertAt(
                        $value,
                        $member = PHP_INT_MAX
                    ): Associable
                    {
                        $this->main[$member] = $value;
                        return $this;
                    }

                    public function offsetSet($offset, $value): void
                    {
                        $this->plusAt($value, $offset);
                    }

                    public function dropAt($member): Associable
                    {
                        unset($this->main[$member]);
                        return $this;
                    }

                    public function offsetUnset($offset): void
                    {
                        $this->minusAt($offset);
                    }

                    public function dropFirst($length = 1): Associable
                    {
                        return Shoop::this("");
                    }

                    public function dropLast($length = 1): Associable
                    {
                        return Shoop::this("");
                    }

                    public function each(callable $callable): Associable
                    {
                        return Shoop::this("");
                    }

                    public function retain(callable $callable): Associable
                    {
                        return Shoop::this("");
                    }

                    public function drop(callable $callable): Associable
                    {
                        return Shoop::this("");
                    }

                    public function rewind(): void
                    {
                        rewind($this->main);
                    }

                    public function valid(): bool
                    {
                        $member = key($this->main);
                        return array_key_exists($member, $this->main);
                    }

                    public function current()
                    {
                        $member = key($temp);
                        return $temp[$member];
                    }

                    public function key()
                    {
                        key($this->main);
                    }

                    public function next(): void
                    {
                        next($this->main);
                    }
                }
            )
        );
    }
}
