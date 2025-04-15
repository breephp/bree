<?php

declare(strict_types=1);

namespace Bree\Objects;

use Bree\Concerns\AsNumeric;
use Bree\Contracts\IsNumeric;

class NumericObject implements IsNumeric
{
    use AsNumeric;

    public function __construct(protected int|float|string $value) {}

    public function get(): int|float|string
    {
        return $this->value;
    }
}
