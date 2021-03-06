<?php
declare(strict_types=1);

namespace JoshBruce\DiceTower;

use Eightfold\Foldable\Fold;

class Dn extends Fold
{
    private $sides = 6;

    private $roll;

    static public function withSides(int $sides = 6)
    {
        return static::fold($sides);
    }

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    public function roll()
    {
        if ($this->roll === null) {
            $this->roll = random_int(1, $this->sides);
        }
        return $this->roll;
    }

    public function result()
    {
        return $this->roll();
    }

    public function __debugInfo()
    {
        return [
            "sides" => $this->sides,
            "roll"  => $this->roll()
        ];
    }

    public function __toString()
    {
        return "{$this->roll()}";
    }
}
