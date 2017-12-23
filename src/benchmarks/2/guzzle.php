<?php

require_once __DIR__ . '/../../bootstrap.php';

use GuzzleHttp\Client;
use GuzzleHttp\Pool;

$client = new Client();

$requests = function ($total) use ($client) {
    $uri = 'https://www.google.be';

    for ($i = 0; $i < $total; $i++) {
        yield function() use ($client, $uri) {
            return $client->getAsync($uri);
        };
    }
};

$pool = new Pool($client, $requests(20));

$promise = $pool->promise();

$promise->wait();
