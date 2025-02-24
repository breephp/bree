<?php

declare(strict_types=1);

namespace Bridget\Concerns;

trait WithValue
{
    protected mixed $value;

    public function setValue(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function valueIs(mixed $value): bool
    {
        return $this->value === $value;
    }
}
