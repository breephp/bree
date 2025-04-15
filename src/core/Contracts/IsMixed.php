<?php

declare(strict_types=1);

namespace Bree\Contracts;

interface IsMixed
{
    public function __invoke(mixed $value = null): mixed;

    public function get(): mixed;

    public static function of(mixed $value): self;
}
