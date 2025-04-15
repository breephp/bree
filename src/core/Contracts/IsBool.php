<?php

declare(strict_types=1);

namespace Bree\Contracts;

interface IsBool extends IsScalar
{
    public function __invoke(mixed $value = null): bool;

    public function get(): bool;

    public function isTrue(): bool;

    public function isFalse(): bool;

    public function toTrue(): self;

    public function toFalse(): self;
}
