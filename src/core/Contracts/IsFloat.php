<?php

declare(strict_types=1);

namespace Bree\Contracts;

interface IsFloat extends IsNumber
{
    public function __invoke(mixed $value = null): float;

    public function get(): float;
}
