<?php
declare(strict_types=1);

namespace Eightfold\Foldable;

use League\Pipeline\Pipeline;

use Eightfold\Foldable\Foldable;
use Eightfold\Foldable\FoldableImp;

use Eightfold\Foldable\Filterable;
use Eightfold\Foldable\FilterableImp;

/**
 * A Filter is simialar to a Fold in that it is the atomic class.
 *
 * See `Tests\Bends\ArrayToString` see how extending this class can reduce your
 * workload. All the other implementations replicate this skeleton for fine-
 * grained control. Extending this class is just easier.
 *
 * You will be required to write an `__invoke` method. We cannot add it the
 * defined interfaces while giving your flexibility for argument lists as
 * improved type safety.
 */
abstract class Filter implements Foldable, Filterable
{
    use FoldableImp, FilterableImp;
}
