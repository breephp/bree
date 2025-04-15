<?php

declare(strict_types=1);

namespace Bree\Objects;

use Bree\Concerns\AsString;
use Bree\Contracts\IsString;

class StringObject implements IsString
{
    use AsString;

    public function __construct(protected string $value) {}

    public function get(): string
    {
        return $this->value;
    }
}
