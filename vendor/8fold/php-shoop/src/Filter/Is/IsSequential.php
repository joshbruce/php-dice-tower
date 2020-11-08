<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Is;

class IsSequential extends Filter
{
    public function __invoke($using): bool
    {
        if (Is::object()->unfoldUsing($using)) {
            return false;

        } elseif (Is::boolean()->unfoldUsing($using)) {
            return false;

        } elseif (Is::number()->unfoldUsing($using)) {
            return false;

        } elseif (Is::list()->unfoldUsing($using)) {
            if (Is::array()->unfoldUsing($using)) {
                return true;
            }
            return false;

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return false;
            }
            return true;

        } elseif (Is::tuple()->unfoldUsing($using)) {
            return false;

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
