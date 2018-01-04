<?php

require_once __DIR__ . '/../../bootstrap.php';

use Spatie\Async\Pool;

$pool = Pool::create()->concurrency(50);

foreach (range(1, 50) as $i) {
    $pool[] = async(function () use ($i) {
        $sleep = 1;

        if ($i % 2 === 0) {
            $sleep = 2;
        } else if ($i % 3 === 0) {
            $sleep = 3;
        }

        sleep($sleep);
    });
}

await($pool);
