<?php

declare(strict_types=1);

namespace Bree\Contracts;

interface IsNumeric extends IsScalar
{
    public function __invoke(mixed $value = null): int|float|string;

    public function get(): int|float|string;
}
