<?php

require_once __DIR__ . '/../../bootstrap.php';

Amp\Parallel\Worker\pool(new Amp\Parallel\Worker\DefaultPool(16));

$counter = 0;

for ($i = 1; $i <= 50; $i++) {
    $promises[] = Amp\ParallelFunctions\parallel(function () {
        sleep(1);

        return 2;
    })->onResolve(function ($error, $output) use (&$counter) {
        $counter += $output;
    });
}

Amp\Promise\wait(Amp\Promise\all($promises));
