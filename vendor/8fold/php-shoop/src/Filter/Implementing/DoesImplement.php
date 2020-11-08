<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter\Implementing;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Filter\Is\IsObject;

/**
 * @version 1.0.0
 */
class DoesImplement extends Filter
{
    public function __invoke($using): bool
    {
        if (IsObject::apply()->unfoldUsing($using)) {
            return is_a($using, $this->main);
        }
        return false;
    }
}
