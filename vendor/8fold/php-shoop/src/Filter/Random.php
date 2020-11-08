<?php
declare(strict_types=1);

namespace Eightfold\Shoop\Filter;

use Eightfold\Foldable\Filter;

use Eightfold\Shoop\Shoop;

/**
 * @todo - update for 1.0.0
 */
class Random extends Filter
{
    private $count = 1;

    public function __construct(int $count = 1)
    {
        $this->count = $count;
    }

    public function __invoke($using)
    {
        if (TypeIs::applyWith("boolean")->unfoldUsing($using)) {
            return Shoop::pipe($using,
                TypeAsArray::applyWith($this->main)->unfoldUsing($using)
            )->unfold();

        } elseif (TypeIs::applyWith("number")->unfoldUsing($using)) {
            return Shoop::pipe($using,
                TypeAsArray::applyWith($this->main)->unfoldUsing($using)
            )->unfold();

        } elseif (TypeIs::applyWith("list")->unfoldUsing($using)) {
            $usingCount = TypeAsInteger::apply()->unfoldUsing($using);
            if ($usingCount === 0) {
                return [];

            }

            $limit = ($usingCount < $this->count) ? $usingCount : $this->count;
            $range = TypeAsArray::applyWith()->unfoldUsing($limit - 1);

            $random = array_rand($range, $limit);
            if (! is_array($random)) {
                $random = [$random];
            }

            $build = [];
            foreach ($random as $index) {
                if ($limit === 1) {
                    return $using[$index];
                }
                $build[] = $using[$index];
            }
            return $build;

        } elseif (TypeIs::applyWith("json")->unfoldUsing($using)) {
            return Shoop::pipe($using,
                TypeAsArray::applyWith($this->main)->unfoldUsing($using)
            )->unfold();

        } elseif (TypeIs::applyWith("string")->unfoldUsing($using)) {
            return Shoop::pipe($using,
                TypeAsArray::applyWith($this->main)->unfoldUsing($using)
            )->unfold();

        } elseif (TypeIs::applyWith("tuple")->unfoldUsing($using) or
            TypeIs::applyWith("object")->unfoldUsing($using)
        ) {
            return Shoop::pipe($using,
                TypeAsArray::applyWith($this->main)->unfoldUsing($using)
            )->unfold();

        }
    }
}
