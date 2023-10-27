<?php

declare(strict_types=1);

return [
    'generator' => [
        'example_type' => [
            'namespace' => 'App\\Example\\Namespace',
            'stub' => 'path/to/real/stub/example_type.stub',
            'interface' => [
                'namespace' => 'App\\Example\\Namespace\\{CLASS}\\Interfaces',
                'stub' => 'path/to/real/stub/example_type_interface.stub',
                'suffix' => 'Interface',
            ],
            // 'extends' => ClassName::class,
            'run_previous' => 'other_type'
        ],
        'other_type' => [
            'namespace' => 'App\\Example\\OtherNamespace',
            'stub' => 'path/to/real/stub/other_type.stub',
            'prefix' => 'Prefix',
            'suffix' => 'Suffix',
        ],
    ],
    'default' => [
        'stub' => 'path/to/real/stub/example_type.stub',
        'namespace' => 'App\\Example\\Default'
    ]
];
