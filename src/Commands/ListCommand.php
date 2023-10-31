<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace CyBorgs\Hyperf\CGen\Commands;

class ListCommand extends BaseCommand
{
    public function __construct()
    {
        parent::__construct('list');
    }

    public function handle()
    {
        $this->output->writeln('List of configured types:');
        foreach ($this->getConfig('generator') as $key => $item) {
            $this->output->writeln("<info>{$key}: {$item['namespace']}</info>");
        }
        $this->output->writeln('If you need create more, change generator key on config/autoload/cgen.php');
        return 0;
    }
}
