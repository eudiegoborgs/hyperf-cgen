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
return [
    'generator' => [
        'test_type' => [
            'namespace' => 'CyBorgs\\Hyperf\\CGen\\Custom',
            'stub' => __DIR__ . '/stubs/class.stub',
            'run_previous' => [
                'other_type',
                'interface',
            ],
        ],
        'other_type' => [
            'namespace' => 'CyBorgs\\Hyperf\\CGen\\OtherCustom',
            'stub' => __DIR__ . '/stubs/other_class.stub',
            'prefix' => 'Prefix',
            'suffix' => 'Suffix',
        ],
        'interface' => [
            'namespace' => 'CyBorgs\\Hyperf\\CGen\\Custom\\%CLASS%\\Interfaces',
            'stub' => __DIR__ . '/stubs/interface.stub',
            'suffix' => 'Interface',
        ],
    ],
    'default' => [
        'stub' => 'path/to/real/stub/example_type.stub',
        'namespace' => 'App\\Example\\Default',
    ],
];
