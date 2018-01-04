<?php

require_once __DIR__ . '/../../bootstrap.php';

use Spatie\Async\Pool;

$pool = Pool::create();

foreach (range(1, 50) as $i) {
    $pool[] = async(function () {
        return true;
    });
}

await($pool);
