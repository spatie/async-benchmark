<?php

require_once __DIR__ . '/../../bootstrap.php';

$pool = Spatie\Async\Pool::create();
$pool->concurrency(16);
$counter = 0;

for ($i = 1; $i <= 500; $i++) {
    $pool[] = async(function () {
        return 2;
    })->then(function ($output) use (&$counter) {
        $counter += $output;
    });
}

await($pool);
