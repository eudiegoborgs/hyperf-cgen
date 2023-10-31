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

namespace Tests\CyBorgs\Hyperf\CGen;

use CyBorgs\Hyperf\CGen\Commands\CreateCommand;
use CyBorgs\Hyperf\CGen\Commands\ListCommand;
use CyBorgs\Hyperf\CGen\ConfigProvider;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class ConfigProviderTest extends TestCase
{
    public function testInvoke()
    {
        $config = (new ConfigProvider())();
        $this->assertEquals([
            CreateCommand::class,
            ListCommand::class,
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
