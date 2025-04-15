<?php

declare(strict_types=1);

namespace Bree\Objects;

use Bree\Concerns\AsMixed;
use Bree\Contracts\IsMixed;

class MixedObject implements IsMixed
{
    use AsMixed;

    public function __construct(protected mixed $value) {}

    public function get(): mixed
    {
        return $this->value;
    }
}
