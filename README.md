# CGen for Hyperf 

CGen is a Custom Class Generator library to optimize your hyperf development experience. 

If you use this library, you can make stub for your classes and create code structure with only one command.

[![Latest Stable Version](http://poser.pugx.org/eudiegoborgs/hyperf-cgen/v)](https://packagist.org/packages/eudiegoborgs/hyperf-cgen) 
[![Total Downloads](http://poser.pugx.org/eudiegoborgs/hyperf-cgen/downloads)](https://packagist.org/packages/eudiegoborgs/hyperf-cgen)
[![License](http://poser.pugx.org/eudiegoborgs/hyperf-cgen/license)](https://packagist.org/packages/eudiegoborgs/hyperf-cgen) 
[![PHP Version Require](http://poser.pugx.org/eudiegoborgs/hyperf-cgen/require/php)](https://packagist.org/packages/eudiegoborgs/hyperf-cgen)

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

```

### Create stub files

This is a stub for other type:

```php
// path/to/real/stub/other_type.stub
<?php

declare(strict_types=1);

namespace %NAMESPACE%;

class %CLASS%
{

}
```


This is a stub for example type interface:

```php
// path/to/real/stub/example_type_interface.stub
<?php

declare(strict_types=1);

namespace %NAMESPACE%;

interface %CLASS%
{

}
```

This is a stub for example type:

```php
// path/to/real/stub/example_type_interface.stub
<?php

declare(strict_types=1);

namespace %NAMESPACE%;

use %other_type.NAMESPACE%\%other_type.CLASS%;

class %CLASS%
{
    public function __construct(
        private %other_type.CLASS% %other_type.VARIABLE_NAME%
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

namespace CyBorgs\Hyperf\CGen\OtherCustom;

class PrefixMyClassNameSuffix
{
    
}
```

Show the MyClassNameInterface.php file
```php
<?php

declare(strict_types=1);

namespace CyBorgs\Hyperf\CGen\Custom\MyClassName\Interfaces;

class MyClassNameInterface
{
    
}
```

Show the MyClassName.php file
```php
<?php

declare(strict_types=1);

namespace CyBorgs\Hyperf\CGen\Custom;

use CyBorgs\Hyperf\CGen\OtherCustom\PrefixMyClassNameSuffix;

class MyClassName
{
    public function __construct(
        private PrefixMyClassNameSuffix $classTest
    ) {}
}
```
