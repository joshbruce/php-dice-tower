<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once("../vendor/autoload.php");

use JoshBruce\DiceTower\DicePool;

$common = DicePool::roll4d20();

print "<p>". $common ."</p>";

$initial = DicePool::roll(4, 6);

print "<p>". $initial ."</p>";

$highest = $initial->highest(3);

print "<p>". $highest ."</p>";

$initial = DicePool::roll(4, 6);

print "<p>". $initial ."</p>";

$lowest = $initial->lowest(3);

print "<p>". $lowest ."</p>";
