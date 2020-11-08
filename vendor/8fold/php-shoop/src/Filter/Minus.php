<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;

/**
 * @version 1.0.0
 */
class Minus extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            // if (Is::object()->unfoldUsing($using)) {
            //     return static::fromObject($using);
            // }
            // return static::fromTuple($using, $this->main);

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using);

        } elseif (Is::number()->unfoldUsing($using)) {
            return static::fromNumber($using, ...$this->args(true));

        // } elseif (Is::list()->unfoldUsing($using)) {
        //     return static::fromList($using, $this->main);

        // } elseif (Is::string()->unfoldUsing($using)) {
        //     if (Is::json()->unfoldUsing($using)) {
        //         return static::fromTuple($using, $this->main);
        //     }
        //     return static::fromString($using, $this->main);

        }
    }

    // TODO: PHP 8 - int|float, int|float -> int|float
    static public function fromNumber($using, $subtracter)
    {
        return $using - $subtracter;
    }

    /**
     * true, true  : back and front
     * true, false : front only
     * false, true : back only
     * false, false: all occurrences
     *
     * TODO: PHP 8 - string, bool, bool, array|int
     */
    // private function fromString(
    //     string $using,
    //     array $charMask = [" ", "\t", "\n", "\r", "\0", "\x0B"],
    //     bool $fromStart = true,
    //     bool $fromEnd   = true
    // ): string
    // {
    //     $fromStartAndEnd = ($fromStart and $fromEnd) ? true : false;
    //     $all             = (! $fromStart and ! $fromEnd) ? true : false;

    //     if ($fromStartAndEnd) {
    //         $charMask = TypeAsString::apply()->unfoldUsing($charMask);
    //         return trim($using, $charMask);

    //     } elseif ($fromStart) {
    //         $charMask = TypeAsString::apply()->unfoldUsing($charMask);
    //         return ltrim($using, $charMask);

    //     } elseif ($fromEnd) {
    //         $charMask = TypeAsString::apply()->unfoldUsing($charMask);
    //         return rtrim($using, $charMask);

    //     } elseif ($all) {
    //         return str_replace($charMask, "", $using);

    //     }
    // }
}
