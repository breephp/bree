<?php

declare(strict_types=1);

namespace Bree\Contracts;

use Throwable;

interface IsException extends Throwable
{
    /**
     * @param  array<string|int>  $arguments
     */
    public static function with(string $message = '', array $arguments = [], int $code = 0, ?Throwable $previous = null): self;
}
