# 8fold Shoop for PHP

Shoop is a horizontally-consistent interface into PHP, whereas PHP could be described as a vertically-consistent interface into C.

Shoop is built on [8fold Foldable](https://github.com/8fold/php-foldable) allowing for ubiquitous construction of data objects.

## Installation

```
composer require 8fold/php-shoop
```

## Usage

Contrived examples...live examples coming soon and available in the tests folder.

Apply a single filter.

```php
Apply::plus(1)->unfoldUsing(2);
// indirect call to output: 3

Plus::applyWith(1)->unfoldUsing(2);
// direct call to output: 3
```

Pipe multiple filters.

```php
Shoop::pipe(2,
	Apply::plus(1),
	Apply::divide(1)
)->unfold();
// output: 3
```

Nesting pipes and filters. (Variation on part of the `PlusAt` Filter.)

```php
Shoop::pipe([1, 2, 3],
	Apply::from(0, 1), // output: [1, 2]
	Apply::plus("hello"), // output: [1, 2, "hello"]
	Apply::plus(
		Apply::from(1)->unfoldUsing([1, 2, 3]) // output: [3]
	)
)->unfold();
// output [1, 2, "hello", 3]
```

Fluent using method chaining.

```php
Shoop::this(2)->plus(1)->divide(2)->unfold();
// output 1.5

Shooped::fold(2)->plus(1)->divide(2)->unfold();
// output: 1.5
```

### Types and type juggling

Shoop defines abstract and concrete types.

Abstract Shoop types map directly to PHP types.

|Type name  |PHP type(s)                                           |
|:----------|:-----------------------------------------------------|
|Content    |PHP boolean, float, integer, and string.              |
|Collection |PHP array, stdClass, object without public methods.   |
|List       |PHP array.                                            |
|Sequential |PHP indexed array, integer, string.                   |
|Object     |PHP object that can only be juggled *from*, not *to*. |

Concrete Shoop types:

1. MUST be self-defined as what they *are* or are *like* as opposed to what they are *not*.
2. MUST juggle reasonably to all other Shoop concrete types except object.

|Type name  |Abstract type(s)    |Definition                                                                                |
|:----------|:-------------------|:-----------------------------------------------------------------------------------------|
|Boolean    |Content             |same as PHP                                                                               |
|Number     |''                  |all real numbers                                                                          |
|Integer    |''                  |all whole numbers                                                                         |
|String     |''                  |same as PHP                                                                               |
|Dictionary |Collection, List    |a PHP array with string keys (associative array)                                          |
|Array      |Collection, List    |a PHP array with integer indeces (indexed array) in sequential order starting from 0      |
|Tuple      |Collection          |a PHP object containing only public properties with non-null values                       |
|JSON       |Content, Collection |see String and Tuple                                                                      |
|Object     |Object              |see Tuple, with at least one defined public method - or implementing Shoop type interfaces|

Note: Rather than being implemented as PHP classes, Shoop types are *interpretations* of PHP types you implement. Shoop types facilitate type juggling, transformations, and the application of filters.

### Filters

Filters are PHP classes inheriting from the Shoop abstract filter and implementing the interface methods required by that inheritance.

Filters generally act as a bridge between Shoopland and PHP. They can be viewed as low-level functions used to manipulate PHP types. For a manipulation to become a filter, it MUST meet AT LEAST three of the following:

1. Used at least three times in one or more production project(s), which MAY include Shoop itself. ex. Reversed::fromBoolean
2. Fully testing the proposed filter results in testing multiple other filters. ex. IsEmpty::fromTuple
3. The proposed filter DOES NOT require testing because it uses PHP directly. ex. IsEmpty::fromString
4. The proposed filter DOES NOT require testing because it uses approved filters that do not require testing. ex. AsBoolean::*

Note: If the fourth item is used as a reason for the proposed filter to be approved, it SHOULD be accompanied by a specific reason. For example, the AsBoolean filter facilitates juggling to that concrete type and returns the result of IsNotEmpty, which returns the result of IsEmpty that is Reversed. Neither AsBoolean nor IsNotEmpty require testing; however, it is a DRY way of implementing the PHP bool casting operation for most PHP types.

By complying with the previous, the following requirement should be met automatically:

1. The proposed filter MUST be fully tested, directly or inderectly.

Note: With Shoop, objects are fully specifiable PHP types, as you can implement their representation as any and all Shoop-supported PHP types.

### Deviations from PHP

In order to make Shoop easy to adopt we try not to deviate too much from what you're accustomed to. The following details the known deviations from PHP standard behavior:

|Shoop |PHP |
|:-----|:---|
|You can transform (cast) any Shoop type to any other Shoop type, except object. |Some castings result in error; array to string, for example. |
|Interfaces exist to define the PHP type representation of custom types or instances implementing the interface. |PHP is limited in this regard: see the Stringable and JsonSerializable interfaces as well as some magic methods. |
|Boolean as string returns the english-equivalent. ex. "true" |PHP converts to an integer, then stringify that result. ex. "1" |
|Boolean as dictionary returns a two-key dictionary holding both true and false values. |PHP uses the boolean value as the first index. |
|Boolean as array uses the array values of the dictionary where zero holds the value of false. |PHP does not differentiate between dictionaries and arrays. |
|JSON can be converted to a dictionary but not created that way. The transformation is non-recursive; so, inner objects remain objects. The string representation MUST start and end with opening and closing curly braces, respectively. |The PHP json_decode() function can return a PHP associative array where inner objects are converted to associative arrays. The string representation can start and end using opening and closing square brackets. |

### Performance

Each test we write covers performance for speed and memory usage.

When it comes to speed, our goal is that every filter can be applied and returned in less than one millisecond (represented as 1.0 in our tests).

Our starting point for speed checks is one microsecond (0.001 in our tests). If a test goes over one microsecond, but less than 5 microseconds, we bump the speed check by one microsecond (ex. 0.001001 becomes 0.002) while leaving the previous, shorter run(s) as comment notes. If a test goes over five microseconds (0.005) we switch to 10 microsecond intervals (ex. 0.005 becomes 0.01). In all other cases, we round up to the nearest 10 microsecond mark (ex. 0.010001 becomes 0.02).

When it comes to memory, our goal is that every filter can be applied and returned using less than 1 kilobyte of memory (1 in our tests). This will be based somewhat on what is passed to the filter. Our tests are measured with a bare miminum value passed in to verify the test delivers the expected result.

Our tests are also written using the filter pattern:

```php
AssertEquals::applyWith(
	// expected return value
	// expected return type
	// max time allowed in milliseconds
	// max memory allowed in kilobytes
)->unfoldUsing(
	// the filter being tested
);
```

## Project

### Goals

The primary goals for Shoop, in no particular order:

* Plain language (approachable): PHP is pretty accessible to new developers who maybe don't have a computer science background; Shoop continues this theme.
* Syntactically and semantically light: PHP is understandably heavy on syntax (special characters to help the parser) and semantically expansive when it comes to capabilities (short function names, but many of them). We review Filters and capabilities based on production need, not gut feel and "because we can."
* Immutable: Whenever possible, we return new instances and values as opposed to altering the state.
* Type-safe: The flexibility of Shoop means we don't check types every step along the way, but do check types before returning the result of a request.
* Defer processing: Whenever possible we defer processing until the last possible moment.
* Ubiquity across types: We favor a small number of filters that can then be minimally configured using arguments.
* DRY (don't repeat yourself): We strive to leverage capabilities already available in Shoop rather than implementing PHP solutions; most of the Filters came from developing a different Filter.
* Let nothing mean nothing: As developers, we spend a lot of time accounting for, working around, and defending against things that represent nothing. `null` is arguably the most known thing representing nothing, Shoop doesn't use nor account for `null`. `false` also equates to zero, which represents nothing. The idea that zero represents nothing is the primary argument for Shoop arrays to start at one, as requesting the "nothing index" should always result in receiving nothing...something cannot be contained by nothing.

An oft cited criticism of PHP is its inconsistent API. PHP's creator, [Rasmus, has explained it](https://youtu.be/Qa_xVjTiOUw) this way (paraphrased):

> PHP is perfectly consistent, just not the way you expect. It's vertically consistent. So, for every function in PHP,  if you look at what's underneath it, the `libc` function under some of the string functions, for example, the argument order and naming matches what they're built upon. So, there's not consistency horitzontally, but there's perfect consistency vertically digging down into the stack.

If you use classes from the [Illuminate Support](https://laravel.com/api/5.5/Illuminate/Support.html) portion of Laravel or some of the [Symfony Components](https://symfony.com/doc/current/components/index.html), you're familiar with the desire for horizontally consistent APIs problem (even beyond PHP itself).

While this immplementation is language-specific, the fundamental concepts, patterns, and naming strive to be language agnostic.

PHP is extremely [simple for new developers](https://www.php.net/manual/en/intro-whatis.php), Shoop follows this tradition.

### Contributing

For more general advice see our [Contributing](https://github.com/8fold/php-shoop/blob/master/.github/CONTRIBUTING.md) documentation.

### What's in a name?

Shoop, as an acronym, points to the insipirations of the library:

- Swift, Smalltalk, and Squeak;
- Haskell (functional programming and immutability);
- Object-Oriented (encapsulation, composition, and communication); and
- Procedural (sequential, logical programming).

Shoop, as a word, is akin to "photoshopping" (and sounds nicer than "Foops").

Shoop, as a name, is the title of a song by Salt-N-Pepa released in 1993 and used in the first installment of the [Deadpool](https://youtu.be/FOJWJmlYxlE) franchise in 2016.

### Other

- [Versioning](https://github.com/8fold/php-shoop/blob/master/.github/VERSIONING.md)
- [Governance](https://github.com/8fold/php-shoop/blob/master/.github/GOVERNANCE.md)

## History

This library has been under development since the beginning of 2019 and has been used in the majority of 8fold projects since the middle of 2019. With every new project created we tried to go without it but found ourselves becoming annoyed, which is why we've decided to make it a more formal project and library consumable by others.














***

We offer multiple Interfaces and default Implementations for juggling between the supported, concrete types. Each interface offers two methods: one returns an object implementing the interface and the other returns the PHP types. The former are prefixed with "as" for use in Fluent Interfaces. The latter are prefixed with "ef" and can be thought of as similar to [PHP Magic Methods](https://www.php.net/manual/en/language.oop5.magic.php) which are prefixed with a double-underscore (`__`).

?? - abstract and concrete filters - ??

- Abstract filters use other filters to generate the output.
- Concrete filters DO NOT use other filters to generate the output.

### PHP deviations

#### Boolean

|Shoop                                            |Shoop result                                 |PHP equivalent   |PHP result                  |
|:------------------------------------------------|:--------------------------------------------|:----------------|:---------------------------|
|`TypeAsInteger::apply()->unfoldUsing(false)`     |0                                            |`count(false)`   |PHP warning                 |
|`TypeAsString::apply()->unfoldUsing(false)`      |"false"                                      |`(string) false` |"0"                         |
|`TypeAsArray::apply()->unfoldUsing(false)`       |[0 => true, 1 => false]                      |`(array) false`  |[0] => false                |
|`TypeAsDictionary::apply()->unfoldUsing(false)`  |["false" => true, "true" => false]           |''               |''                          |
|`TypeAsTuple::apply()->unfoldUsing(false)`       |object(["false"] => true, ["true"] => false) |`(object)` false |object(["scalar"] => false) |

#### Number and integer

|Shoop                                            |Shoop result                                   |PHP equivalent   |PHP result                  |
|:------------------------------------------------|:----------------------------------------------|:----------------|:---------------------------|
|`TypeAsInteger::apply()->unfoldUsing(2)`         |2                                              |`count(2)`       |PHP warning                 |
|`TypeAsArray::apply()->unfoldUsing(2)`           |[0 => 0, 1 => 1, 2 => 2]                       |`(array) 2`      |[0 => 2]                    |
|`TypeAsDictionary::apply()->unfoldUsing(2)`      |["i0" => 0, "i1" => 1, "i2" => 2]              |''               |''                          |
|`TypeAsTuple::apply()->unfoldUsing(2)`           |object(["i0"] => 0, ["i1"] => 1, ["i2"] => 2]) |`(object) 2`     |object(["scalar"] => 2)     |

Should array to tuple be the PHP default for array to object?? Reduces deviations.

#### String

|Shoop                                            |Shoop result                                  |PHP equivalent   |PHP result                  |
|:------------------------------------------------|:---------------------------------------------|:----------------|:---------------------------|
|`TypeAsInteger::apply()->unfoldUsing("Hi!")`     |3                                             |`(int) "Hi!"`    |0                           |
|`TypeAsInteger::apply()->unfoldUsing("Hi!")`     |3                                             |`count("Hi!")`   |PHP warning                 |
|`TypeAsArray::apply()->unfoldUsing("Hi!")`       |[0 => "H", 1 => "i", 2 => "!"]                |`(array) "Hi!"`  |[0 => "Hi!"]                |
|`TypeAsDictionary::apply()->unfoldUsing("Hi!")`  |["content" => "Hi!"]                          |''               |''                          |
|`TypeAsTuple::apply()->unfoldUsing("Hi!")`       |object(["content"] => "Hi!")                  |`(object) "Hi!"` |object(["scalar"] => "Hi!") |

#### Dictionary, tuple, and JSON

Ditionary and tuple deviate from PHP in similar ways, syntax might be different.

|Shoop                                                       |Shoop result     |PHP equivalent                 |PHP result                     |
|:-----------------------------------------------------------|:----------------|:------------------------------|:------------------------------|
|`TypeAsInteger::apply()->unfoldUsing(["a" => 1, "b" => 2])` |2                |`(int) ["a" => 1, "b" => 2]`   |1                              |
|`TypeAsInteger::apply()->unfoldUsing(["a" => 1, "b" => 2])` |2                |`count(["a" => 1, "b" => 2])`  |2                              |
|`TypeAsString::apply()->unfoldUsing(["a" => 1, "b" => 2])`  |"", configurable |`(string) ["a" => 1, "b" => 2]`|PHP Notice: Array to string... |
|`TypeAsArray::apply()->unfoldUsing(["a" => 1, "b" => 2])`   |[0 => 1, 1 => 2] |`(array) ["a" => 1, "b" => 2]` |["a" => 1, "b" => 2]           |

Note: A JSON string is converted to a Tuple, and a Tuple is converted to a Dictionary.

Note: The default implementation of the PHP JsonSerialize interface results in the PHP type being converted to a Shoop Tuple, then being encoded.

#### Array

|Shoop                                                |Shoop result                         |PHP equivalent        |PHP result                         |
|:----------------------------------------------------|:------------------------------------|:---------------------|:----------------------------------|
|`TypeAsInteger::apply()->unfoldUsing(["a", "b"])`    |2                                    |`(int) ["a", "b"]`    |1                                  |
|`TypeAsString::apply()->unfoldUsing(["a", "b"])`     |"ab", configurable                   |`(string) ["a", "b"]` |PHP Notice: Array to string...     |
|`TypeAsDictionary::apply()->unfoldUsing(["a", "b"])` |["i0" => "a", "i1" => "b"]           |`(array) ["a", "b"]`  |["a", "b"]                         |
|`TypeAsTuple::apply()->unfoldUsing(["a", "b"])`      |object(["i0"] => "a", ["i1"] => "b") |`(object) ["a", "b"]` |object(["0"] => "a", ["1"] => "b") |

Should array to tuple be the PHP default for array to object?? Reduces deviations. Accessing those properties doesn't work as expected.

ex. $object = object(["0"] => 1, ["1"] => 2):

- $object->0   = parse error
- $object->"0" = parse error
- $object->{0} = expected behavior

#### Object

ex. `$using = new class {}`

|Shoop                                         |Shoop result                                         |PHP equivalent    |PHP result                  |
|:---------------------------------------------|:----------------------------------------------------|:-----------------|:---------------------------|
|`TypeAsBoolean::apply()->unfoldUsing($using)` |false: Opposite of `IsEmpty`, can be overridden      |`(bool) $using`   |true, cannot be overridden  |
|`IsEmpty::apply()->unfoldUsing($using)`       |true: Boolean of `TypeAsInteger`, can be overridden  |`empty($using)`   |false, cannot be overridden |
|`TypeAsInteger::apply()->unfoldUsing($using)  |0 (count of public properties), can be overridden    |`(int) $using`    |PHP Notice...               |
|`TypeAsNumber::apply()->unfoldUsing($using)   |0.0 (count of public properties)                     |`(float) $using`  |''                          |
|`TypeAsString::apply()->unfoldUsing($using)   |"" (concatenated string properties), can be overridden |`(string) $using` |''                          |
|`TypeAsArray::apply()->unfoldUsing($using)    |[]                                                   |`(array) $using`  |[]                          |
|`TypeAsTuple::apply()->unfoldUsing($using)    |object(): all methods and private properties removed |`(object) $using` |object(): all methods are removed, private properties remain |
