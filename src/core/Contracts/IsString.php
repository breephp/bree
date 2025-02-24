<?php

declare(strict_types=1);

namespace Bridget\Contracts;

interface IsString extends IsScalar
{
    public function __invoke(mixed $value = null): string;

    public function get(): string;
}
