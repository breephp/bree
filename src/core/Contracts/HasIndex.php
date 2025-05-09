<?php

declare(strict_types=1);

namespace Bree\Contracts;

interface HasIndex
{
    public function setIndex(int $index): static;

    public function getIndex(): int;

    public function indexIs(int $index): bool;
}
