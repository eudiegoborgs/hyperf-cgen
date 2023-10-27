<?php

declare(strict_types=1);

namespace Tests\CyBorgs\Hyperf\CGen;

use CyBorgs\Hyperf\CGen\Commands\CreateCommand;
use CyBorgs\Hyperf\CGen\ConfigProvider;
use PHPUnit\Framework\TestCase;

class ConfigProviderTest extends TestCase
{

    public function test__invoke()
    {
        $config = (new ConfigProvider())();
        $this->assertEquals([
            CreateCommand::class
        ], $config['commands']);
        $this->assertEquals([
            [
                'id' => 'config',
                'description' => 'File to config custom classes generator',
                'source' => str_replace('/tests/', '/src/', __DIR__ . '/../publish/cgen.php'),
                'destination' => BASE_PATH . '/config/autoload/cgen.php',
            ],
        ], $config['publish']);
    }
}

