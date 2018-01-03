<?php

require_once __DIR__ . '/../../bootstrap.php';

use GuzzleHttp\Client;
use Spatie\Async\Pool;

$pool = Pool::create()
    ->autoload(__DIR__ . '/../../../vendor/autoload.php');
$pool->concurrency(16);

for ($i = 1; $i <= 50; $i++) {
    $pool[] = async(function () {
        $client = new Client();

        return $client->get('https://www.example.com/');
    });
}

await($pool);
