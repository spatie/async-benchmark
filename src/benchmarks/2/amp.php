<?php

require_once __DIR__ . '/../../bootstrap.php';

use Amp\Parallel\Worker\DefaultPool;
use function Amp\ParallelFunctions\parallelMap;
use function Amp\Promise\wait;

$pool = new DefaultPool(50);

$promises = parallelMap(range(1, 50), function ($i) {
    return true;
}, $pool);

wait($promises);
