<?php

use JoshBruce\DiceTower\Tests;

use PHPUnit\Framework\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use JoshBruce\DiceTower\DicePool;

class DiceTowerTest extends TestCase
{
    /**
     * @test
     */
    public function roll_d6()
    {
        $actual = DicePool::roll();
        $this->assert($actual, 1, 6, 1);

        $actual = DicePool::roll(2);
        $this->assert($actual, 2, 12, 2);
    }

    /**
     * @test
     */
    public function roll_4d6_keep_highest_3()
    {
        $actual = DicePool::roll(4, 6)->highest(3);
        $sum = array_sum($actual);

        $this->assertEquals(3, count($actual));
        $this->assertLessThanOrEqual(24, $sum);
        $this->assertGreaterThanOrEqual(3, $sum);
    }

    public function assert($sut, $diceCount = 1, $highest = 6, $lowest = 1)
    {
        $count = count($sut->rolls());
        $this->assertEquals($diceCount, $count);

        $sum = $sut->sum();
        $this->assertLessThanOrEqual($highest, $sum);
        $this->assertGreaterThanOrEqual($lowest, $sum);
    }
}
