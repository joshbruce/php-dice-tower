<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Foldable;
use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\TypeJuggling\AsDictionary;
use Eightfold\Shoop\Filter\TypeJuggling\AsTuple;

/**
 * @todo Test
 */
class Prepend extends Filter
{
    public function __invoke($using)
    {
        if (Is::object(false)->unfoldUsing($using)) {
            if (Is::object()->unfoldUsing($using)) {
                return static::fromObject($using, $this->main);
            }
            return static::fromTuple($using, $this->main);

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using, $this->main);

        // } elseif (Is::number()->unfoldUsing($using)) {
        //     return static::fromNumber($using, $this->main);

        } elseif (Is::list()->unfoldUsing($using)) {
            return static::fromList($using, $this->main);

        } elseif (Is::string()->unfoldUsing($using)) {
            if (Is::json()->unfoldUsing($using)) {
                return static::fromTuple($using, $this->main);
            }
            return static::fromString($using, $this->main);
        }
    }

    static public function fromString(string $using, string $prefix): string
    {
        return Append::fromString($prefix, $using);
    }

    static public function fromList(array $using, array $prefix): array
    {
        return Append::fromList($prefix, $using);
    }

    static public function fromTuple($using, $prefix): object
    {
        $using  = AsDictionary::fromTuple($using);
        $prefix = AsDictionary::apply()->unfoldUsing($prefix);
        $dictionary = static::fromList($prefix, $using);
        return AsTuple::fromList($dictionary);
    }
}
