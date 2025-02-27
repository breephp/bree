<?php

declare(strict_types=1);

namespace Spl\Exceptions;

use Throwable;

interface ExceptionInterface extends Throwable
{
    /**
     * @param  array<string|int>  $arguments
     */
    public static function new(string $message = '', array $arguments = [], int $code = 0, ?Throwable $previous = null): Throwable;
}
