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

use CyBorgs\Hyperf\CGen\Entities\ClassConfig;
use CyBorgs\Hyperf\CGen\Exceptions\CannotCreateClassException;
use Exception;
use Hyperf\Stringable\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CreateCommand extends BaseCommand
{
    public function __construct()
    {
        parent::__construct('create');
    }

    public function handle()
    {
        try {
            $type = $this->input->getArgument('type');
            $this->build($type);
        } catch (Exception $exception) {
            $this->output->writeln(sprintf('<fg=red>%s</>', $exception->getMessage()));
            return 0;
        }

        $this->output->writeln('<info>Finish with success</info>');
        return 0;
    }

    /**
     * @throws CannotCreateClassException
     */
    protected function build(string $type): ClassConfig
    {
        $class_config = $this->generateClassConfig($type);
        $run_previous_result = [];
        if ($this->cannotWriteFile($class_config)) {
            throw new CannotCreateClassException(
                sprintf('%s already exists!', $class_config->getQualifyClass())
            );
        }
        foreach ($class_config->getRunPrevious() as $run_previous) {
            $run_previous_result[$run_previous] = $this->build($run_previous);
        }
        $this->output->writeln(
            sprintf(
                '<info>%s created successfully.</info>',
                $this->makeFile($class_config, $run_previous_result)
            )
        );
        return $class_config;
    }

    protected function getCustomConfig(string $type): array
    {
        $key = 'generator.' . Str::snake($type, '.');
        return $this->getConfig($key);
    }

    protected function getDefaultConfig(): array
    {
        return $this->getConfig('default');
    }

    protected function generateClassConfig(string $type): ClassConfig
    {
        $attributes = array_merge(
            $this->getDefaultConfig(),
            $this->getCustomConfig($type),
            $this->input->getArguments()
        );
        return ClassConfig::fromArray($attributes);
    }

    protected function cannotWriteFile(ClassConfig $class_config): bool
    {
        return ! $this->isOverwriteEnable() && $this->thisClassAlreadyExists($class_config);
    }

    protected function thisClassAlreadyExists(ClassConfig $class_config): bool
    {
        return is_file($class_config->getClassPath());
    }

    protected function isOverwriteEnable(): bool
    {
        return (bool) $this->input->getOption('force');
    }

    /**
     * Build the directory for the class if necessary.
     */
    protected function makeFile(ClassConfig $class_config, array $run_previous = []): string
    {
        $path = $class_config->getClassPath();
        if (! is_dir(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        file_put_contents($path, $this->buildClass($class_config, $run_previous));

        return $path;
    }

    protected function replaceNamespace(
        string $stub_data,
        ClassConfig $class_config,
        string $namespace_key = '%NAMESPACE%'
    ): string {
        return str_replace(
            [$namespace_key],
            [$class_config->getNamespace()],
            $stub_data
        );
    }

    protected function replaceClassName(
        string $stub_data,
        ClassConfig $class_config,
        string $name_key = '%CLASS%'
    ): string {
        return str_replace(
            [$name_key],
            [$class_config->getSanitizedClassName()],
            $stub_data
        );
    }

    protected function replaceVariableName(
        string $stub_data,
        ClassConfig $class_config,
        string $name_key = '%VARIABLE_NAME%'
    ): string {
        $variable_name = $class_config->getVariableName();
        return str_replace(
            [$name_key],
            ['$' . $variable_name],
            $stub_data
        );
    }

    /**
     * Build the class with the given name.
     */
    protected function buildClass(ClassConfig $class_config, array $run_previous = []): string
    {
        var_dump($class_config->getStub());
        $stub = file_get_contents($class_config->getStub());
        $stub = $this->replaceNamespace($stub, $class_config);
        $stub = $this->replaceVariableName($stub, $class_config);
        foreach ($run_previous as $key => $item) {
            $stub = $this->replaceNamespace($stub, $item, "%{$key}.NAMESPACE%");
            $stub = $this->replaceClassName($stub, $item, "%{$key}.CLASS%");
            $stub = $this->replaceVariableName($stub, $item, "%{$key}.VARIABLE_NAME%");
        }
        return $this->replaceClassName($stub, $class_config);
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
