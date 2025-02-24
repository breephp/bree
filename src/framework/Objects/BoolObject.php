<?php

declare(strict_types=1);

namespace Bridget\Objects;

use Bridget\Concerns\AsBool;
use Bridget\Contracts\IsBool;

class BoolObject implements IsBool
{
    use AsBool;

    public function __construct(protected bool $value) {}

    public function get(): bool
    {
        return $this->value;
    }
}
