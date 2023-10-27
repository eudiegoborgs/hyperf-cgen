# CGen for Hyperf 

CGen is a Custom Class Generator library to optimize your hyperf development experience. 

If you use this library, you can make stub for your classes and create code structure with only one command.

## Installation

```
composer require eudiegoborgs/hyperf-cgen
```

## Configuration 

Publish the config file so you can define your own rules
``` 
php bin/hyperf.php vendor:publish eudiegoborgs/hyperf-cgen
```

The config file will show up in the following path:

``` 
config/autoload/cgen.php
```

Here in the file you can define your own creation rules for specific classes

```php
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
            'extends' => ClassName::class,
            'run_previous' => 'other_type'
        ],
        'other_type' => [
            'namespace' => 'App\\Example\\OtherNamespace',
            'stub' => 'path/to/real/stub/other_type.stub',
            'prefix' => 'Prefix',
            'suffix' => 'Suffix',
        ],
    ],
];
```

### Create stub files

This is a stub for other type:

```php
<?php
// path/to/real/stub/other_type.stub

declare(strict_types=1);

namespace %NAMESPACE%;

class %CLASS%
{
    
}
```


This is a stub for example type interface:

```php
<?php
// path/to/real/stub/example_type_interface.stub

declare(strict_types=1);

namespace %NAMESPACE%;

interface %CLASS%
{
    
}
```

This is a stub for example type:

```php
<?php
// path/to/real/stub/example_type_interface.stub

declare(strict_types=1);

namespace %NAMESPACE%;

class %CLASS%
{
    public function __construct(
        private readonly %RUN_PREVIOUS_RESULT_CLASS% %RUN_PREVIOUS_RESULT_VAR_NAME% 
    ) {}
}
```

## Usage

To create a new class you need run this command:
``` 
php bin/hyperf.php cgen:create example_type MyClassName 
```

After you run command, this lib will create for you files using your stubs with this structure:

``` 
src/
    - Example/
        - Namespace/
            - MyClassName/
                - Interfaces/
                    - MyClassNameInterface.php
            - MyClassName.php
        - OtherNamespace/
            PrefixMyClassNameSuffix.php
```

Show the PrefixMyClassNameSuffix.php file
```php
<?php

declare(strict_types=1);

namespace App\Example\OtherNamespace;

class PrefixMyClassNameSuffix
{
    
}
```

Show the MyClassNameInterface.php file
```php
<?php

declare(strict_types=1);

namespace App\Example\Namespace\MyClassName\Interfaces;

class MyClassNameInterface
{
    
}
```

Show the MyClassName.php file
```php
<?php

declare(strict_types=1);

namespace App\Example\Namespace;

use App\ClassName;
use App\Example\Namespace\MyClassName\Interfaces\MyClassNameInterface;

class MyClassNameInterface extends ClassName implements MyClassNameInterface
{
    public function __construct(
        private readonly PrefixMyClassNameSuffix $prefixMyClassNameSuffix 
    ) {}
}
```
