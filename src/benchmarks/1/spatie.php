<?php

require_once __DIR__ . '/../../bootstrap.php';

use Spatie\Async\Pool;

$pool = Pool::create();
$counter = 0;

for ($i = 1; $i <= 30; $i++) {
    $pool[] = async(function () {
        sleep(1);

        return 2;
    })->then(function ($output) use (&$counter) {
        $counter += $output;
    });
}

await($pool);
