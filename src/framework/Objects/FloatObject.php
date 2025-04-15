<?php

declare(strict_types=1);

namespace Bree\Objects;

use Bree\Concerns\AsFloat;
use Bree\Contracts\IsFloat;

class FloatObject implements IsFloat
{
    use AsFloat;

    public function __construct(protected float $value) {}

    public function get(): float
    {
        return $this->value;
    }
}
