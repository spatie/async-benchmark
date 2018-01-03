<?php

require_once __DIR__ . '/../../bootstrap.php';

use function Amp\ParallelFunctions\parallelMap;
use function Amp\Promise\wait;

$promises = parallelMap(range(1, 30), function ($i) {
    $sleep = 1;

    if ($i % 2 === 0) {
        $sleep = 2;
    } else if ($i % 3 === 0) {
        $sleep = 3;
    }

    sleep($sleep);
});

$result = wait($promises);
