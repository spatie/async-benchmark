<?php

require_once __DIR__ . '/../../bootstrap.php';

Amp\Parallel\Worker\pool(new Amp\Parallel\Worker\DefaultPool(16));

$counter = 0;

for ($i = 1; $i <= 500; $i++) {
    $promise = Amp\ParallelFunctions\parallel(function () {
        return 2;
    })();

    $promise->onResolve(function ($error, $output) use (&$counter) {
        $counter += $output;
    });

    $promises[] = $promise;
}

Amp\Promise\wait(Amp\Promise\all($promises));
