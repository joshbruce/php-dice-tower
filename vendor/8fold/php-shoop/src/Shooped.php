<?php
declare(strict_types=1);

namespace Eightfold\Shoop;

use Eightfold\Foldable\Foldable;
use Eightfold\Foldable\FoldableImp;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Apply;

use Eightfold\Shoop\FilterContracts\Shooped as ShoopedInterface;

use Eightfold\Shoop\FilterContracts\Interfaces\Addable;
use Eightfold\Shoop\FilterContracts\Interfaces\Appendable;
use Eightfold\Shoop\FilterContracts\Interfaces\Arrayable;
use Eightfold\Shoop\FilterContracts\Interfaces\Associable;
use Eightfold\Shoop\FilterContracts\Interfaces\Comparable;
use Eightfold\Shoop\FilterContracts\Interfaces\Countable;
use Eightfold\Shoop\FilterContracts\Interfaces\Divisible;
use Eightfold\Shoop\FilterContracts\Interfaces\Emptiable;
use Eightfold\Shoop\FilterContracts\Interfaces\Falsifiable;
use Eightfold\Shoop\FilterContracts\Interfaces\Prependable;
use Eightfold\Shoop\FilterContracts\Interfaces\Reversible;
use Eightfold\Shoop\FilterContracts\Interfaces\Stringable;
use Eightfold\Shoop\FilterContracts\Interfaces\Subtractable;
use Eightfold\Shoop\FilterContracts\Interfaces\Tupleable;
use Eightfold\Shoop\FilterContracts\Interfaces\TypeCheckable;

class Shooped implements ShoopedInterface
{
    use FoldableImp;

    public function __construct($main)
    {
        $this->main = $main;
    }

// - Concatenation
    public function append($value): Appendable
    {
        return static::fold(
            Apply::append($value)->unfoldUsing($this->main)
        );
    }

    public function endsWith($value): Appendable
    {
        return static::fold(
            Apply::endsWith($value)->unfoldUsing($this->main)
        );
    }

    public function efEndsWith($value): bool
    {
        return $this->endsWith($value)->unfold();
    }

    public function prepend($value): Prependable
    {
        return static::fold(
            Apply::prepend($value)->unfoldUsing($this->main)
        );
    }

    public function startsWith($value): Prependable
    {
        return static::fold(
            Apply::startsWith($value)->unfoldUsing($this->main)
        );
    }

    public function efStartsWith($value): bool
    {
        return $this->startsWith($value)->unfold();
    }

// - TypeCheckable
    public function isArray(): TypeCheckable
    {
        return static::fold(
            Apply::isArray()->unfoldUsing($this->main)
        );
    }

    public function efIsArray(): bool
    {
        return $this->isArray()->unfold();
    }

    public function isBoolean(): TypeCheckable
    {
        return static::fold(
            Apply::isBoolean()->unfoldUsing($this->main)
        );
    }

    public function efIsBoolean(): bool
    {
        return $this->isBoolean()->unfold();
    }

    public function isDictionary(): TypeCheckable
    {
        return static::fold(
            Apply::isDictionary()->unfoldUsing($this->main)
        );
    }

    public function efIsDictionary(): bool
    {
        return $this->isDictionary()->unfold();
    }

    public function isNumber(): TypeCheckable
    {
        return static::fold(
            Apply::isNumber()->unfoldUsing($this->main)
        );
    }

    public function efIsNumber(): bool
    {
        return $this->isNumber()->unfold();
    }

    public function isInteger(): TypeCheckable
    {
        return static::fold(
            Apply::isInteger()->unfoldUsing($this->main)
        );
    }

    public function efIsInteger(): bool
    {
        return $this->isInteger()->unfold();
    }

    public function isJson(): TypeCheckable
    {
        return static::fold(
            Apply::isJson()->unfoldUsing($this->main)
        );
    }

    public function efIsJson(): bool
    {
        return $this->isJson()->unfold();
    }

    public function isString(): TypeCheckable
    {
        return static::fold(
            Apply::isString()->unfoldUsing($this->main)
        );
    }

    public function efIsString(): bool
    {
        return $this->isString()->unfold();
    }

    public function isTuple(): TypeCheckable
    {
        return static::fold(
            Apply::isTuple()->unfoldUsing($this->main)
        );
    }

    public function efIsTuple(): bool
    {
        return $this->isTuple()->unfold();
    }

// - Maths
    // TODO: PHP 8 - mixed, string|int
    public function plus($value): Addable
    {
        return static::fold(
            Apply::plus($value)->unfoldUsing($this->main)
        );
    }

    // TODO: PHP 8 - array|int
    public function minus(
        $items = [" ", "\t", "\n", "\r", "\0", "\x0B"],
        bool $fromStart = true,
        bool $fromEnd   = true
    ): Subtractable
    {
        return static::fold(
            Apply::minus($items, $fromStart, $fromEnd)->unfoldUsing($this->main)
        );
    }

    public function divide(
        $divisor,
        $includeEmpties = true,
        $limit = PHP_INT_MAX
    ): Divisible
    {
        return static::fold(
            Apply::divide($divisor, $includeEmpties, $limit)
                ->unfoldUsing($this->main)
        );
    }

// - Arrayable
    public function asArray(): Arrayable
    {
        return static::fold(
            Apply::asArray()->unfoldUsing($this->main)
        );
    }

    public function efToArray(): array
    {
        return $this->asArray()->unfold();
    }

// - Associable
    public function asDictionary(): Associable
    {
        return static::fold(
            Apply::asDictionary()->unfoldUsing($this->main)
        );
    }

    public function efToDictionary(): array
    {
        return $this->asDictionary()->unfold();
    }

    public function has($value): Falsifiable
    {
        // TODO: Consider switching priority - call efHas and wrap result, is
        //      there a performance difference?? Are people using fluent more
        //      likely to continue chaining or wanting to bail??
        return static::fold(
            Apply::has($value)->unfoldUsing($this->main)
        );
    }

    public function efHas($value): bool
    {
        return $this->has($value)->unfold();
    }

    public function hasAt($member): Falsifiable
    {
        return static::fold(
            Apply::hasAt($member)->unfoldUsing($this->main)
        );
    }

    public function offsetExists($offset): bool // ArrayAccess
    {
        return $this->hasAt($offset)->unfold();
    }

    public function at($member)
    {
        return static::fold(
            Apply::at($member)->unfoldUsing($this->main)
        );
    }

    public function first($length = 1)
    {
        return static::fold(
            Apply::first($length)->unfoldUsing($this->main)
        );
    }

    public function last($length = 1)
    {
        return static::fold(
            Apply::last($length)->unfoldUsing($this->main)
        );
    }

    public function offsetGet($offset) // ArrayAccess
    {
        return $this->at($offset)->unfold();
    }

    public function insertAt(
        $value, // mixed
        $member = PHP_INT_MAX // int|string
    ): Associable
    {
        $this->main = Apply::insertAt($value, $member)
            ->unfoldUsing($this->main);
        return $this;
    }

    public function offsetSet($offset, $value): void // ArrayAccess
    {
        $this->plusAt($value, $offset);
    }

    public function dropAt($member): Associable
    {
        $this->main = Apply::dropAt($member)->unfoldUsing($this->main);
        return $this;
    }

    public function dropFirst($length = 1): Associable
    {
        return static::fold(
            Apply::dropFirst($length)->unfoldUsing($this->main)
        );
    }

    public function dropLast($length = 1): Associable
    {
        return static::fold(
            Apply::dropLast($length)->unfoldUsing($this->main)
        );
    }

    public function offsetUnset($offset): void // ArrayAcces
    {
        $this->main = $this->dropAt($member);
    }

    public function each(callable $callable): Associable
    {
        return static::fold(
            Apply::eachUsing($callable)->unfoldUsing($this->main)
        );
    }

    public function retain(callable $callable): Associable
    {
        return static::fold(
            Apply::retainUsing($callable)->unfoldUsing($this->main)
        );
    }

    public function drop(callable $callable): Associable
    {
        return static::fold(
            Apply::dropUsing($callable)->unfoldUsing($this->main)
        );
    }

    private $temp;

    /**
     * rewind() -> valid() -> current() -> key() -> next() -> valid()...repeat
     */
    public function rewind(): void // Iterator
    {
        $this->temp = (Apply::isSequential()->unfoldUsing($this->main))
        // $this->temp = (TypeIs::applyWith("sequential")->unfoldUsing($this->main))
            ? Apply::asArray()->unfoldUsing($this->main)
            : Apply::asDictionary()->unfoldUsing($this->main);
    }

    public function valid(): bool // Iterator
    {
        if (! isset($this->temp)) {
            $this->rewind();
        }
        $member = key($this->temp);
        return array_key_exists($member, $this->temp);
    }

    public function current() // Iterator
    {
        if (! isset($this->temp)) {
            $this->rewind();
        }
        $temp = $this->temp;
        $member = key($temp);
        return $temp[$member];
    }

    public function key() // Iterator
    {
        if (! isset($this->temp)) {
            $this->rewind();
        }
        return key($this->temp);
    }

    public function next(): void // Iterator
    {
        if (! isset($this->temp)) {
            $this->rewind();
        }
        next($this->temp);
    }

// - Emptiable TODO: create interface
    public function isEmpty(): Emptiable
    {
        return static::fold(
            Apply::isEmpty()->unfoldUsing($this->main)
        );
    }

    public function efIsEmpty(): bool
    {
        return $this->isEmpty()->unfold();
    }

// - Falsifiable
    public function asBoolean(): Falsifiable
    {
        return static::fold(
            Apply::asBoolean()->unfoldUsing($this->main)
        );
    }

    public function efToBoolean(): bool
    {
        return $this->asBoolean()->unfold();
    }

// - Stringable
    public function asString(string $glue = ""): Stringable
    {
        return static::fold(
            Apply::asString($glue)->unfoldUsing($this->main)
        );
    }

    public function efToString(string $glue = ""): string
    {
        return $this->asString($glue)->unfold();
    }

    public function __toString(): string
    {
        return $this->efToString();
    }

// - Tupleable
    public function asTuple(): Tupleable
    {
        return static::fold(
            Apply::asTuple()->unfoldUsing($this->main)
        );
    }

    public function efToTuple(): object
    {
        return $this->asTuple()->unfold();
    }

    public function asJson(): Tupleable
    {
        return static::fold(
            Apply::asJson()->unfoldUsing($this->main)
        );
    }

    public function efToJson(): string
    {
        return $this->asJson()->unfold();
    }

    public function jsonSerialize(): object // JsonSerializable
    {
        return $this->efToTuple()->unfold();
    }

// - Countable
    public function asInteger(): Countable
    {
        return static::fold(
            Apply::asInteger()->unfoldUsing($this->main)
        );
    }

    public function efToInteger(): int
    {
        return $this->asInteger()->unfold();
    }

    public function length(): Countable
    {
        return static::fold(
            Apply::length()->unfoldUsing($this->main)
        );
    }

    public function count(): int
    {
        return $this->length()->unfold();
    }

// - Comparable
    public function is($compare): Falsifiable
    {
        return static::fold(
            Apply::isIdenticalTo($compare)->unfoldUsing($this->main)
        );
    }

    public function isGreaterThan($compare): Falsifiable
    {
        return static::fold(
            Apply::isGreaterThan($compare)->unfoldUsing($this->main)
        );
    }

    public function isGreaterThanOrEqualTo($compare): Falsifiable
    {
        $is = $this->is($compare);
        if ($is->efToBoolean()) {
            return static::fold(
                $is->unfold()
            );
        }

        $isGreaterThan = $this->isGreaterThan($compare);
        if ($isGreaterThan->efToBoolean()) {
            return static::fold(
                $isGreaterThan->unfold()
            );
        }

        return static::fold(false);
    }

// - Reversible
    public function reversed(): Reversible
    {
        return static::fold(
            Apply::reversed()->unfoldUsing($this->main)
        );
    }
}
