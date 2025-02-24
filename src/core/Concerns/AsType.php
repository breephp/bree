<?php

declare(strict_types=1);

namespace Bridget\Concerns;

trait AsType
{
    protected bool $nullable = false;

    public function allowsNull(): bool
    {
        return $this->nullable;
    }
}
