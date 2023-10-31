<?php

declare(strict_types=1);

namespace Tests\CyBorgs\Hyperf\CGen\Commands;

use CyBorgs\Hyperf\CGen\Commands\CreateCommand;
use CyBorgs\Hyperf\CGen\Entities\ClassConfig;
use Hyperf\Context\ApplicationContext;
use Hyperf\Contract\ConfigInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommandTest extends TestCase
{

    public function testExecute()
    {
        $inputData = [
            'type' => 'test_type',
            'name' => 'ClassTest',
            'force' => true
        ];
        $input = $this->createMock(InputInterface::class);
        $input->expects($this->any())
            ->method('getArgument')
            ->willReturnCallback(fn($key) => $inputData[$key] ?? null);
        $input->expects($this->any())
            ->method('getArguments')
            ->willReturn($inputData);
        $output = $this->createMock(OutputInterface::class);

        $config = $this->createMock(ConfigInterface::class);
        $config->expects($this->any())
            ->method('get')
            ->willReturnCallback(fn ($key) => match($key) {
                'cgen.generator.test_type' => [
                    'namespace' => 'CyBorgs\\Hyperf\\CGen\\Custom',
                    'stub' => __DIR__ . '/stubs/class.stub',
                    'run_previous' => [
                        'other_type',
                        'interface'
                    ]
                ],
                'cgen.generator.other_type' => [
                    'namespace' => 'CyBorgs\\Hyperf\\CGen\\OtherCustom',
                    'stub' => __DIR__ . '/stubs/other_class.stub',
                    'prefix' => 'Prefix',
                    'suffix' => 'Suffix',
                ],
                'cgen.generator.interface' => [
                    'namespace' => 'CyBorgs\\Hyperf\\CGen\\Custom\\%CLASS%\\Interfaces',
                    'stub' => __DIR__ . '/stubs/interface.stub',
                    'suffix' => 'Interface',
                ],
                'cgen.default' => [
                    'namespace' => 'CyBorgs\\Hyperf\\CGen',
                    'stub' => __DIR__ . '/stubs/class.stub',
                ],
            });

        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
            ->method('get')
            ->with(ConfigInterface::class)
            ->willReturn($config);

        ApplicationContext::setContainer($container);

        $command = new CreateCommand();
        $command->run($input, $output);
    }
}

