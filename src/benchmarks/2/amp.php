<?php

require_once __DIR__ . '/../../bootstrap.php';

use GuzzleHttp\Client;
use function Amp\ParallelFunctions\parallelMap;
use function Amp\Promise\wait;

$promises = parallelMap(range(1, 50), function () {
    $client = new Client();

    return $client->get('https://www.google.be');
});

wait($promises);
