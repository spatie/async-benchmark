<?php

require_once __DIR__ . '/../../bootstrap.php';

use GuzzleHttp\Client;
use Spatie\Async\Pool;

$pool = Pool::create()
    ->autoload(__DIR__ . '/../../../vendor/autoload.php');

for ($i = 1; $i <= 20; $i++) {
    $pool[] = async(function () {
        $client = new Client();

        return $client->get('https://www.google.be');
    });
}

await($pool);
