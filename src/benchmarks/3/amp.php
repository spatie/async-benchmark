<?php

require_once __DIR__ . '/../../bootstrap.php';

use Amp\Process\Process;

$script = escapeshellarg(__DIR__ . '/child-process.php');

for ($i = 1; $i <= 50; $i++) {
    $process = new Process("exec php {$script} {$i}");
    $process->start();

    $promises[] = $process->join();
    $processes[] = $process;
}

Amp\Promise\wait(Amp\Promise\all($promises));
