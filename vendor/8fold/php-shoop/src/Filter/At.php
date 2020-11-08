<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Apply;

use Eightfold\Shoop\Filter\Is\IsIdenticalTo;

use Eightfold\Shoop\Filter\TypeJuggling\AsDictionary;
use Eightfold\Shoop\Filter\TypeJuggling\AsArray;
use Eightfold\Shoop\Filter\TypeJuggling\AsString;

/**
 * @todo - invocation, applicable type methods
 */
class At extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            if (Is::object()->unfoldUsing($using)) {
                return static::fromObject($using);
            }
            return static::fromTuple($using, $this->main);

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using);

        // } elseif (Is::number()->unfoldUsing($using)) {
        //     return static::fromNumber($using, ...$this->args(true));

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using, $this->main);

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return static::fromTuple($using, $this->main);
            }
            return static::fromString($using, $this->main);
        }
    }

    static public function fromString(string $using, int $position)
    {
        $string = Divide::fromString($using);
        return static::fromList($string, $position);
    }

    /**
     * @todo PHP 8 - , int|string
     */
    static public function fromList(array $using, $member)
    {
        return $using[$member];
    }

    static public function fromTuple($using, string $member)
    {
        $dictionary = AsDictionary::fromTuple($using);
        return static::fromList($dictionary, $member);
    }
}
