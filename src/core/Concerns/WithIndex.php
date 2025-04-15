<?php

declare(strict_types=1);

namespace Bree\Concerns;

trait WithIndex
{
    protected int $index;

    public function setIndex(int $index): static
    {
        $this->index = $index;

        return $this;
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function indexIs(int $index): bool
    {
        return $this->index === $index;
    }
}
