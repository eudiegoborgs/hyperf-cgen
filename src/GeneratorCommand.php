<?php

declare(strict_types=1);

namespace CyBorgs\Hyperf\CGen;

use Hyperf\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GeneratorCommand extends Command
{
    protected ?InputInterface $input = null;

    protected ?OutputInterface $output = null;

    public function handle()
    {
        // TODO: Implement handle() method.
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['type', InputArgument::REQUIRED, 'The type of the class'],
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Whether force to rewrite.'],
        ];
    }
}
