<?php

declare(strict_types=1);

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
