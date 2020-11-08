<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\TypeJuggling;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\Filter\Divide;
use Eightfold\Shoop\Filter\Type;

use Eightfold\Shoop\Filter\Traverse\RetainUsing;

use Eightfold\Shoop\Filter\Is;
use Eightfold\Shoop\Filter\Implementing\IsStringable;

use Eightfold\Shoop\FilterContracts\Interfaces\Stringable;

/**
 * @todo invocation - done ??
 */
class AsString extends Filter
{
    public function __invoke($using): string
    {
        if (Is::object(false)->unfoldUsing($using)) {
            if (Is::object()->unfoldUsing($using)) {
                return static::fromObject($using);
            }
            return static::fromTuple($using);

        } elseif (Is::boolean()->unfoldUsing($using)) {
            return static::fromBoolean($using);

        } elseif (Is::number()->unfoldUsing($using)) {
            if (Is::string()->unfoldUsing($this->main)) {
                $this->main = 1;
            }
            return static::fromNumber($using, ...$this->args(true));

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using, ...$this->args(true));

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return static::fromJson($using);
            }
            return static::fromString($using, ...$this->args(true));
        }
    }

    static public function fromBoolean(bool $using): string
    {
        return ($using) ? "true" : "false";
    }

    // TODO: PHP 8 - int|float
    /**
     * Convert a given number to a string representation of that number.
     *
     * @param  int|integer|float|double $using             The number to process.
     * @param  int|integer              $decimalPlaces     Number of decimal places to force. Default is 1 to circumvent dynamic typing back to an integer or float when used as members of dictionaries and tuples.
     * @param  string                   $decimalPoint      The character to separate whole numbers and decimal values.
     * @param  string                   $thousandSeparator The character to separate counts of one-thousand.
     * @return string                                      A string in the specified format.
     */
    static public function fromNumber(
        $using,
        int $decimalPlaces        = 1,
        string $decimalPoint      = ".",
        string $thousandSeparator = ","
    ): string
    {
        return number_format(
            $using,
            $decimalPlaces,
            $decimalPoint,
            $thousandSeparator
        );
    }

    static public function fromString(string $using, string $glue = ""): string
    {
        $array = Divide::fromString($using);
        return static::fromList($array, $glue);
    }

    /**
     * @todo - Move to a different filter called Join, AsString, never takes glue.
     */
    static public function fromList(array $using, string $glue = ""): string
    {
        $array = RetainUsing::fromList($using, "is_string");
        return implode($glue, $array);
    }

    static public function fromTuple($using): string
    {
        $dictionary = AsDictionary::fromTuple($using);
        return static::fromList($dictionary);
    }

    static public function fromJson(string $using): string
    {
        return static::fromTuple($using);
    }

    static public function fromObject(object $using): string
    {
        if (IsStringable::apply()->unfoldUsing($using)) {
            return $using->efToString();
        }
        return static::fromTuple($using);
    }
}
