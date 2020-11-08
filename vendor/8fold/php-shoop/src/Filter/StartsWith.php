<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Is\IsIdenticalTo;

/**
 * @todo - invocation
 */
class StartsWith extends Filter
{
    public function __invoke($using): bool
    {
        if (Is::object(false)->unfoldUsing($using)) {
            // if (Is::object()->unfoldUsing($using)) {
            //     return static::fromObject($using);
            // }
            // $dictionary = AsDictionary::apply()->unfoldUsing($this->main);
            // return static::fromTuple($using, $dictionary);

        // } elseif (Is::boolean()->unfoldUsing($using)) {
        //     return static::fromBoolean($using);

        // } elseif (Is::number()->unfoldUsing($using)) {
        //     return static::fromNumber($using, ...$this->args(true));

        // } elseif (Is::list()->unfoldUsing($using)) {
        //     return static::fromList($using, $this->main);

        } elseif (Is::string()->unfoldUsing($using)) {
            // if (Is::json()->unfoldUsing($using)) {
            //     return static::fromJson($using);
            // }
            // $suffix = AsString::fromList($this->args(true));
            return static::fromString($using, $this->main);
        }
    }

    static public function fromString(string $using, string $prefix): bool
    {
        $prefixLength = Length::fromString($prefix);
        $usingFirst   = First::fromString($using, $prefixLength);
        return IsIdenticalTo::fromString($usingFirst, $prefix);
    }
}
