<?php

declare(strict_types=1);

namespace CyBorgs\Hyperf\CGen\Custom;

use CyBorgs\Hyperf\CGen\OtherCustom\PrefixClassTestSuffix;

class ClassTest
{
    public function __construct(
        private PrefixClassTestSuffix $otherType
    ) {}
}