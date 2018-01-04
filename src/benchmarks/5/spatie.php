<?php

require_once __DIR__ . '/../../bootstrap.php';

use Spatie\Async\Pool;

$pool = Pool::create();

foreach (range(1, 10) as $i) {
    $pool[] = async(function () use ($i) {
        $sleep = 1;

        if ($i % 2 === 0) {
            $sleep = 2;
        } else if ($i % 3 === 0) {
            $sleep = 3;
        }

        usleep($sleep * 10000);
    });
}

await($pool);
