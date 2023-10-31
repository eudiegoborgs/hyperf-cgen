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

namespace CyBorgs\Hyperf\CGen\Exceptions;

use Exception;
use Throwable;

class CannotCreateClassException extends Exception
{
    public function __construct(string $message = 'Cannot create Class', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
