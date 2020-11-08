<?php

namespace Eightfold\Foldable\Tests;

use PHPUnit\Framework\TestCase;

use Eightfold\Foldable\Foldable;

use Eightfold\Foldable\Filterable;
use Eightfold\Foldable\FilterableImp;

class PerformantEqualsTestFilter extends TestCase implements Filterable
{
    use FilterableImp;

    private $expected;
    private $expectedClassName;

    protected $start;
    private $maxMs = 0.3;

    private $maxKb      = 10;
    private $initMemory = 0;

    public function __construct(
        $expected,
        $expectedClassName,
        float $maxMs = 0.3,
        int $maxKb   = 10
    )
    {
        $this->start = hrtime(true);
        $this->maxMs = $maxMs;

        $this->maxKb = $maxKb;

        $this->expected          = $expected;
        $this->expectedClassName = $expectedClassName;

        $this->initMemory = memory_get_usage();
    }

    public function unfoldUsing($using)
    {
        $actual = (is_a($using, Foldable::class)) ? $using->unfold() : $using;

        $postCallMemory = memory_get_usage();

        $end = hrtime(true);

        $this->assertEquals($this->expected, $actual);

        $actual = (is_a($actual, Foldable::class))
            ? get_class($actual)
            : gettype($actual);
        $this->assertEquals($this->expectedClassName, $actual);

        $elapsed = $end - $this->start;
        $ms = $elapsed/1e+6;

        $msPasses = $ms <= $this->maxMs;
        $this->assertTrue($msPasses, "{$ms}ms is greater than {$this->maxMs}ms");

        $usedBytes = $postCallMemory - $this->initMemory;
        $usedKb    = $usedBytes/1024.2;
        $usedKb    = round($usedKb);

        $kbPasses = $usedKb <= $this->maxKb;
        $this->assertTrue($kbPasses, "{$usedKb}kb is greater than {$this->maxKb}kb");
    }
}
