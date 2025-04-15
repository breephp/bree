<?php

declare(strict_types=1);

namespace Bree\Concretes;

final class Let
{
    public static function var(string|object $type, mixed $value): Statement
    {
        if (! $type instanceof Statement && ! \is_subclass_of($type, Statement::class)) {
            throw new \InvalidArgumentException("The $type class must implement the ".Statement::class);
        }

        return $type::parse($value);
    }
}
