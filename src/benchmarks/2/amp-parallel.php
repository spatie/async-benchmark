<?php

require_once __DIR__ . '/../../bootstrap.php';

use GuzzleHttp\Client;
use function Amp\ParallelFunctions\parallel;

Amp\Parallel\Worker\pool(new Amp\Parallel\Worker\DefaultPool(16));

for ($i = 1; $i <= 50; $i++) {
    $promises[] = parallel(function () {
        $client = new Client();

        return $client->get('https://www.example.com/');
    })();
}

Amp\Promise\wait(Amp\Promise\all($promises));
