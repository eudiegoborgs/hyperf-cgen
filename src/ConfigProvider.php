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
namespace CyBorgs\Hyperf\CGen;

use CyBorgs\Hyperf\CGen\Commands\CreateCommand;
use CyBorgs\Hyperf\CGen\Commands\ListCommand;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
            ],
            'commands' => [
                CreateCommand::class,
                ListCommand::class,
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'File to config custom classes generator',
                    'source' => __DIR__ . '/../publish/cgen.php',
                    'destination' => BASE_PATH . '/config/autoload/cgen.php',
                ],
            ],
        ];
    }
}
