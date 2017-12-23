<?php

namespace Spatie\Async\Benchmark;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class BenchmarkCommand extends Command
{
    public function __construct(?string $name = null)
    {
        parent::__construct('benchmark');

        $this->addArgument('benchmark', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $benchmark = $input->getArgument('benchmark');

        $benchmarkFile = __DIR__ . "/benchmarks/{$benchmark}.php";

        $fileName = __DIR__ . '/../output/' . str_replace('/', '-', $benchmark);

        if (file_exists($fileName)) {
            unlink($fileName);
        }

        $handle = fopen($fileName, 'a');

        for ($i = 1; $i <= 30; $i++) {
            $output->write("Iteration {$i}: ");

            $process = new Process("php {$benchmarkFile}");

            $startTime = microtime(true);

            $process->run();

            if ($process->isSuccessful()) {
                $endTime = microtime(true);

                $executionTime = $endTime - $startTime;
            } else {
                echo $process->getErrorOutput();

                $executionTime = -1;
            }

            $output->writeln("{$executionTime}s");

            fwrite($handle, "{$executionTime}\n");
        }

        fclose($handle);

        $output->writeLn("Results written to {$fileName}");
    }
}
