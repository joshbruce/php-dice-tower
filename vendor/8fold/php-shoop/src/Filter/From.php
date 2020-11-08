<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Apply;

use Eightfold\Shoop\Contracts\Falsifiable;

/**
 * @todo - invocation
 *
 * Return a sequence of values less than or equal to `length` `From` a given `start` position integer.
 *
 * If `main` is a string, the result will be a string of the given length starting with character at the given `start` position. All other types are converted to their `array` representations.
 *
 * If `length` is 1, you will either receice the character at the given position or the value of the array for the given position.
 *
 * PHP Standard Library: `substr` and `array_slice`
 */
class From extends Filter
{
    private $start = 0;
    private $length = PHP_INT_MAX;

    public function __construct($start = 0, $length = PHP_INT_MAX)
    {
        if (is_a($start, Foldable::class)) {
            $start = $start->unfold();
        }
        $this->start = $start;

        if (is_a($length, Foldable::class)) {
            $length = $length->unfold();
        }
        $this->length = $length;
    }

    public function __invoke($using)
    {
    }

    static public function fromString(
        string $using,
        int $start,
        int $length
    ): string
    {
        return substr($using, $start, $length);
    }

    static public function fromList(
        array $using,
        int $start,
        int $length
    ): array
    {
        return array_slice($using, $start, $length);
    }
}
