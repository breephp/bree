<?php

declare(strict_types=1);

namespace Bridget\Concerns;

trait AsNamed
{
    protected string $name = '';

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function nameIs(string $name): bool
    {
        return $this->name === $name;
    }
}
