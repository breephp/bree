<?php

declare(strict_types=1);

namespace Bridget\Objects;

use Bridget\Concerns\AsFloat;
use Bridget\Contracts\IsFloat;

class FloatObject implements IsFloat
{
    use AsFloat;

    public function __construct(protected float $value) {}

    public function get(): float
    {
        return $this->value;
    }
}
