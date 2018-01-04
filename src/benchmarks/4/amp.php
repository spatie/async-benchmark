<?php

require_once __DIR__ . '/../../bootstrap.php';

use Amp\Parallel\Worker\DefaultPool;
use function Amp\ParallelFunctions\parallelMap;
use function Amp\Promise\wait;

$pool = new DefaultPool(50);

$promises = parallelMap(range(1, 50), function ($i) {
    $sleep = 1;

    if ($i % 2 === 0) {
        $sleep = 2;
    } else if ($i % 3 === 0) {
        $sleep = 3;
    }

    sleep($sleep);
}, $pool);

$result = wait($promises);
