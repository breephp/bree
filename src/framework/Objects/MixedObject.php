<?php

declare(strict_types=1);

namespace Bridget\Objects;

use Bridget\Concerns\AsMixed;
use Bridget\Contracts\IsMixed;

class MixedObject implements IsMixed
{
    use AsMixed;

    public function __construct(protected mixed $value) {}

    public function get(): mixed
    {
        return $this->value;
    }
}
