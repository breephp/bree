<?php

declare(strict_types=1);

namespace Bridget\Objects;

use Bridget\Concerns\AsInt;
use Bridget\Contracts\IsInt;

class IntObject implements IsInt
{
    use AsInt;

    public function __construct(protected int $value) {}

    public function get(): int
    {
        return $this->value;
    }
}
