<?php

declare(strict_types=1);

namespace Bree\Contracts;

interface IsNamed
{
    public function setName(string $name): static;

    public function getName(): string;

    public function nameIs(string $name): bool;
}
