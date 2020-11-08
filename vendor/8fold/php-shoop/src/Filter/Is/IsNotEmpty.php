<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Is;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Reversed;

use Eightfold\Shoop\Filter\Is\IsEmpty;

/**
 * @todo invocation
 */
class IsNotEmpty extends Filter
{
    public function __invoke($using): bool
    {
    }

    static public function fromBoolean(bool $using): bool
    {
        $bool = IsEmpty::fromBoolean($using);
        return Reversed::fromBoolean($bool);
    }

    static public function fromString(string $using): bool
    {
        $bool = IsEmpty::fromString($using);
        return Reversed::fromBoolean($bool);
    }

    // TODO: PHP 8 - int|float
    static public function fromNumber($using): bool
    {
        $bool = IsEmpty::fromNumber($using);
        return Reversed::fromBoolean($bool);
    }

    static public function fromList(array $using): bool
    {
        $bool = IsEmpty::fromList($using);
        return Reversed::fromBoolean($bool);
    }

    static public function fromTuple($using): bool
    {
        $bool = IsEmpty::fromTuple($using);
        return Reversed::fromBoolean($bool);
    }

    static public function fromJson(string $using): bool
    {
        $bool = IsEmpty::fromJson($using);
        return Reversed::fromBoolean($bool);
    }

    static public function fromObject(object $using): bool
    {
        $bool = IsEmpty::fromObject($using);
        return Reversed::fromBoolean($bool);
    }
}
