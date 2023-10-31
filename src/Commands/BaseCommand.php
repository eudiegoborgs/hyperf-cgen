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

use Hyperf\Command\Command;
use Hyperf\Context\ApplicationContext;
use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;

abstract class BaseCommand extends Command
{
    /**
     * @var ConfigInterface|mixed
     */
    protected ConfigInterface $config;

    public function __construct(string $command_key)
    {
        $this->config = $this->getContainer()->get(ConfigInterface::class);
        parent::__construct("cgen:{$command_key}");
    }

    public function configure()
    {
        foreach ($this->getArguments() as $argument) {
            $this->addArgument(...$argument);
        }

        foreach ($this->getOptions() as $option) {
            $this->addOption(...$option);
        }
    }

    protected function getConfig(string $key): array
    {
        $key = "cgen.{$key}";
        return $this->config->get($key) ?? [];
    }

    protected function getContainer(): ContainerInterface
    {
        return ApplicationContext::getContainer();
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [];
    }
}
