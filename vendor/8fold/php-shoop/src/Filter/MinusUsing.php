<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

/**
 * @todo - invocation, rename RemoveUsing
 */
class MinusUsing extends Filter
{
    public function __invoke($using)
    {
        // if (TypeIs::applyWith("boolean")->unfoldUsing($using)) {

        // } elseif (TypeIs::applyWith("number")->unfoldUsing($using)) {

        // } elseif (TypeIs::applyWith("list")->unfoldUsing($using)) {
        //     $filtered = ($this->callback === null)
        //         ? array_filter($using)
        //         : array_filter($using, $this->callback);

        //     return TypeAsArray::apply()->unfoldUsing($filtered);

        // } elseif (TypeIs::applyWith("string")->unfoldUsing($using) and
        //     ! TypeIs::applyWith("json")->unfoldUsing($using)
        // ) {

        // } elseif (TypeIs::applyWith("tuple")->unfoldUsing($using) or
        //     TypeIs::applyWith("object")->unfoldUsing($using)
        // ) {

        // }
    }
}
