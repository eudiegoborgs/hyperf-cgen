<?php

declare(strict_types=1);

namespace CyBorgs\Hyperf\CGen\Commands;

class ListCommand extends BaseCommand
{

    public function __construct()
    {
        parent::__construct('list');
    }

    public function handle()
    {
        $this->output->writeln("List of configured types:");
        foreach ($this->getConfig('generator') as $key => $item) {
            $this->output->writeln("<success>{$key}: {$item['namespace']}</success>");
        }
        $this->output->writeln("If you need create more, change generator key on config/autoload/cgen.php");
        return 0;
    }
}
