<?php

declare(strict_types=1);

return [
    'generator' => [
        'test_type' => [
            'namespace' => 'CyBorgs\\Hyperf\\CGen\\Custom',
            'stub' => __DIR__ . '/stubs/class.stub',
            'run_previous' => [
                'other_type',
                'interface'
            ]
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
        'namespace' => 'App\\Example\\Default'
    ]
];
