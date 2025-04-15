<?php

declare(strict_types=1);

namespace Bree\Objects;

use Bree\Concerns\AsBool;
use Bree\Contracts\IsBool;

class BoolObject implements IsBool
{
    use AsBool;

    public function __construct(protected bool $value) {}

    public function get(): bool
    {
        return $this->value;
    }
}
