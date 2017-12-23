<?php

namespace Spatie\Async\Benchmark;

use Symfony\Component\Console\Application;

class Console extends Application
{
    public function __construct()
    {
        parent::__construct();

        $commands = [
            BenchmarkCommand::class
        ];

        $this->addCommands(array_map(function ($class) {
            return new $class();
        }, $commands));
    }
}
