# 8fold Foldable

Foldable is a low-level, lighweight library to facilitate the creation of higher-level wrappers and fluent interfaces.

## Installation

```bash
composer require 8fold/php-foldable
```

## Usage

**Foldables** can either extend the `Fold` class, use the `FoldableImp` default implementation, or implement the `Foldable` interface. Note: The `Fold` class uses and implements the Foldable default implementation and interface.

```php
class MyFoldable extends Fold
{
  public function append(string $string): MyFoldable
  {
    $this->main = $this->main . $string;

    return $this;

    // Note: If you prefer immutability, you can always create a new instance
    //       of the MyFoldable class:
    //
    //       return MyFoldable::fold(...$this->args(true));
  }
}

print MyFoldable::fold("Hello")->append(", World!")->unfold();
// output: Hello, World!
```

The `fold()` static initializer (or named constructor) can take an infinite number of arguments. For the defulat implementation, the first argument is stored as `main` while the others are stored as an array called `args`. To help facilitate immutability, you can retrieve the arguments provided by calling the `args` method; you can also specify that you want the completely list, including main, by calling `args(true)`.

**Filters** are PHP classes implementing the `__invoke` magic method; thereby becoming more like a namespaced global function in the standard library.

```php
class Append extends Filter
{
  public function __invoke($using): string
  {
      if (is_a($using, Pipe::class)) {
          return $using->unfold() . $this->main;
      }
      return $using . $this->main;
  }
}

print Apply::append(", World!")->unfoldUsing("Hello");
// output: Hello, World!

class MyFoldable extends Fold
{
  public function append(string $string): MyFoldable
  {
    $this->main = Append::applyWith($string)->unfoldUsing($this->main);

    return $this;
  }
}

print MyFoldable::fold("Hello")->append(", World!")->unfold();
// output: Hello, World!
```

**Pipes** can be used to apply multiple filters in sequence from a starting point.

```php
class Prepend extends Filter
{
  public function __invoke(string $using): string
  {
      return Append::applyWith($using)->unfoldUsing($this->main);
  }
}

$result = Pipe::fold("World",
  Apply::prepend("Hello, "),
  Apply::append("!")
)->unfold();
// output: Hello, World!

// you can allow filters to take pipes as well
$result = Pipe::fold("World",
  Apply::prepend(
    Pipe::fold("ello",
      Apply::prepend("H"),
      Apply::append(","),
      Apply::append(" ")
    )
  ),
  Apply::append("!")
)->unfold();
```

We also provide an assertion filter in the tests directory call `PerformantEqualsTestFilter`, which can be used to test equality and performance of `Foldables` and `Filters`.

```php
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

class TestCase extends PHPUnitTestCase
{
  /**
  * @test
  */
  public function test_something()
  {
    AssertEquals::applyWith(
      "expected result",
      "expected type",
      0.4 // maximum milliseconds
    )->unfoldUsing(
      Pipe::fold("World",
        Apply::prepend(
          Pipe::fold("ello",
            Apply::prepend("H"),
            Apply::append(","),
            Apply::append(" ")
          )
        ),
        Apply::append("!")
      )
    );
  }
}
```

The start time is start at initialization and stopped after unfolding the passed Foldable or assigning the passed value.

## Details

Primary goals are:

1. Allow for type-safety while giving you flexibility in what that means.
2. Speed. This is a low-level library meant for high-extensibility adding as little processing overhead as possible. Our baseline for performance tests (which is most of them) is 0.3 milliseconds. (If you know of ways to improve the speed, feel free to submit an issue or PR).
3. Anit-null. Whenever possible, we do not accept `null` as a required paramater and do avoid returning null whenever possible. We are not defensive with it; so, much of that responsbility is left to the user.

## Other

- [Versioning](https://github.com/8fold/php-foldable/blob/master/.github/VERSIONING.md)
- [Contributing](https://github.com/8fold/php-foldable/blob/master/.github/CONTRIBUTING.md)
- [Security Policy](https://github.com/8fold/php-foldable/blob/master/.github/SECURITY.md)
- [Code of Coduct](https://github.com/8fold/php-foldable/blob/master/.github/CODE_OF_CONDUCT.md)
- [Governance](https://github.com/8fold/php-foldable/blob/master/.github/GOVERNANCE.md)
