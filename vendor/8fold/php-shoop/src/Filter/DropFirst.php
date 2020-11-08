<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\TypeJuggling\AsArray;
use Eightfold\Shoop\Filter\TypeJuggling\AsDictionary;
use Eightfold\Shoop\Filter\TypeJuggling\AsString;
use Eightfold\Shoop\Filter\TypeJuggling\AsTuple;

/**
 * @version 1.0.0
 */
class DropFirst extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            if (Is::object()->unfoldUsing($using)) {
                return static::fromObject($using, $this->main);
            }
            return static::fromTuple($using, $this->main);

        } elseif (Is::boolean()->unfoldUsing($using)) {
            return static::fromBoolean($using, $this->main);

        } elseif (Is::number()->unfoldUsing($using)) {
            return static::fromNumber($using, $this->main);

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using, $this->main);

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return static::fromTuple($using, $this->main);
            }
            return static::fromString($using, $this->main);
        }
    }

    static public function fromString(string $using, int $length = 1): string
    {
        $array = Divide::fromString($using);
        $array = static::fromList($array, $length);
        return AsString::fromList($array);
    }

    /**
     * @todo PHP 8 - , int
     */
    static public function fromList(array $using, int $length = 1): array
    {
        $array = Reversed::fromList($using);
        $array = DropLast::fromList($array, $length);
        return Reversed::fromList($array);
    }

    static public function fromTuple($using, int $length = 1): object
    {
        $dictionary = AsDictionary::fromTuple($using);
        $dictionary = static::fromList($dictionary, $length);
        return AsTuple::fromList($dictionary);
    }
}
