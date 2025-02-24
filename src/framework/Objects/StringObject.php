<?php

declare(strict_types=1);

namespace Bridget\Objects;

use Bridget\Concerns\AsString;
use Bridget\Contracts\IsString;

class StringObject implements IsString
{
    use AsString;

    public function __construct(protected string $value) {}

    public function get(): string
    {
        return $this->value;
    }
}
