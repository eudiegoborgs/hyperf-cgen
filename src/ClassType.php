<?php

declare(strict_types=1);

namespace CyBorgs\Hyperf\CGen;

class ClassType
{
    public string $namespace;
    public string $stub;
    public ?string $suffix = null;
    public ?string $prefix = null;
    public ?string $extends = null;
    public ?ClassType $interface = null;
    public ?string $run_previous = null;
}
