<?php

require_once __DIR__ . '/../../bootstrap.php';

Amp\Parallel\Worker\pool(new Amp\Parallel\Worker\DefaultPool(16));

Amp\Loop::run(function () {
    $counter = 0;

    for ($i = 1; $i <= 50; $i++) {
        $promises[] = Amp\ParallelFunctions\parallel(function () {
            return 2;
        })();
    }

    $values = yield $promises;
    $counter = array_sum($values);
});
