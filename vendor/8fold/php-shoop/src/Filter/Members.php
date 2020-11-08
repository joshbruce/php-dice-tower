<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;

use Eightfold\Shoop\Filter\Is\IsGreaterThan;

/**
 * @todo - invocation
 */
class Members extends Filter
{
    public function __invoke($using)
    {
        // if (TypeIs::applyWith("boolean")->unfoldUsing($using) or
        //     TypeIs::applyWith("tuple")->unfoldUsing($using)
        // ) {
        //     return Shoop::pipe($using,
        //         TypeAsDictionary::apply(),
        //         Members::apply()
        //     )->unfold();

        // } elseif (TypeIs::applyWith("number")->unfoldUsing($using) or
        //     TypeIs::applyWith("string")->unfoldUsing($using)
        // ) {
        //     return Shoop::pipe($using,
        //         TypeAsArray::apply(),
        //         Members::apply()
        //     )->unfold();

        // } elseif (TypeIs::applyWith("list")->unfoldUsing($using)) {
        //     return array_keys($using);

        // } elseif (TypeIs::applyWith("object")->unfoldUsing($using)) {
        //     if (is_a($using, Associable::class)) {
        //         return Shoop::pipe($using->efToDictionary(),
        //             Members::apply()
        //         )->unfold();
        //     }

        //     return Shoop::pipe($using,
        //         TypeAsDictionary::apply(),
        //         Members::apply()
        //     )->unfold();

        // }
    }

    static public function fromList(array $using): array
    {
        return array_keys($using);
    }

    static public function fromObject(object $using): array
    {
        $build = [];

        // TODO: Move to a fromTuple method - ??
        $properties    = get_object_vars($using);
        $count         = Length::fromList($properties);
        $hasProperties = IsGreaterThan::fromNumber($count, 0);


        $methods    = get_class_methods($using);
        $count      = Length::fromList($methods);
        $hasMethods = IsGreaterThan::fromNumber($count, 0);

        $build["properties"] = ($hasProperties) ? $properties : [];
        $build["methods"]    = ($hasMethods) ? $methods : [];

        return $build;
    }
}
