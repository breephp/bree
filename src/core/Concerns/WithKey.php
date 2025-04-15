<?php

declare(strict_types=1);

namespace Bree\Concerns;

trait WithKey
{
    protected int|string $key;

    public function setKey(int|string $key): static
    {
        $this->key = $key;

        return $this;
    }

    public function getKey(): int|string
    {
        return $this->key;
    }

    public function keyIs(int|string $key): bool
    {
        return $this->key === $key;
    }
}
