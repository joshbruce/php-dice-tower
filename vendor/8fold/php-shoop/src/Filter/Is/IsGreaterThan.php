<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Length;
use Eightfold\Shoop\Filter\Is;

use Eightfold\Shoop\Filter\TypeJuggling\AsDictionary;
use Eightfold\Shoop\Filter\TypeJuggling\AsNumber;

/**
 * @todo invocation
 */
class IsGreaterThan extends Filter
{
    public function __invoke($using): bool
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

    static public function fromBoolean(bool $using, bool $compare): bool
    {
        $using   = AsNumber::fromBoolean($using);
        $compare = AsNumber::fromBoolean($compare);
        return static::fromNumber($using, $compare);
    }

    // TODO: PHP 8 - int|float, int|float
    static public function fromNumber($using, $compare): bool
    {
        return $using > $compare;
    }

    static public function fromString(string $using, string $compare): bool
    {
        return $using > $compare;
    }

    static public function fromList(array $using, array $compare): bool
    {
        $using   = Length::fromList($using);
        $compare = Length::fromList($compare);
        return static::fromNumber($using, $compare);
    }

    static public function fromTuple($using, $compare): bool
    {
        $using   = AsDictionary::fromTuple($using);
        $compare = AsDictionary::fromTuple($compare);
        return static::fromList($using, $compare);
    }
}
