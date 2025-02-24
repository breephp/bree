<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Psr\Container\ContainerExceptionInterface;
use Throwable;

interface IsException extends ContainerExceptionInterface
{
    /**
     * @param  array<string|int>  $arguments
     */
    public static function with(string $message = '', array $arguments = [], int $code = 0, ?Throwable $previous = null): Throwable;
}
