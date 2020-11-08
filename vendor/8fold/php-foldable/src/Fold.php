<?php
declare(strict_types=1);

namespace Eightfold\Foldable;

use Eightfold\Foldable\Foldable;
use Eightfold\Foldable\FoldableImp;

/**
 * Atomic class for developing fluent-based, as opposed to pipeline-based, APIs.
 *
 * You can extend this class. Use `fold()` to instantiate it and use `unfold()`
 * to receive the processed, final value.
 *
 * The first argument given to `fold()` is stored as `main`. Any other argument
 * added to the list is stored as a value in an `args` array.
 *
 * The primary point of extension is writing the conteents of the `unfold()`
 * method. Of course, you can write and overwrite as needed for your
 * use case.
 */
abstract class Fold implements Foldable
{
    use FoldableImp;
}
