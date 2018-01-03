<?php

require_once __DIR__ . '/../../bootstrap.php';

$client = new Amp\Artax\DefaultClient;
$semaphore = new Amp\Sync\LocalSemaphore(16);

for ($i = 1; $i <= 50; $i++) {
    $promises[] = Amp\call(function () use ($client, $semaphore) {
        $lock = yield $semaphore->acquire();
        $response = yield $client->request('https://www.example.com/');
        $body = yield $response->getBody();
    });
}

Amp\Promise\wait(Amp\Promise\all($promises));
