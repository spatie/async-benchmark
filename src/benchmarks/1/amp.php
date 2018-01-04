<?php

require_once __DIR__ . '/../../bootstrap.php';

use function Amp\ParallelFunctions\parallelMap;
use function Amp\Promise\wait;

$promises = parallelMap(range(1, 50), function ($i) {
    return true;
});

wait($promises);
