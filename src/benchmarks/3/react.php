<?php

require_once __DIR__ . '/../../bootstrap.php';

use React\ChildProcess\Process;
use React\EventLoop\Factory;

$loop = Factory::create();
$script = __DIR__ . '/react_process.php';

for ($i = 1; $i <= 30; $i++) {
    $process = new Process("exec php {$script} {$i}");
    $process->start($loop);
}

$loop->run();

