<?php

declare(strict_types=1);

namespace Bree\Objects;

use Bree\Concerns\AsInt;
use Bree\Contracts\IsInt;

class IntObject implements IsInt
{
    use AsInt;

    public function __construct(protected int $value) {}

    public function get(): int
    {
        return $this->value;
    }
}
