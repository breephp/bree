<?php

declare(strict_types=1);

namespace Bridget\Bases;

use Bridget\Contracts\IsOption;

abstract class BaseOption implements IsOption
{
    public function __construct(int|string $key, mixed $value)
    {
        $this->setKey($key)->setValue($value);
    }
}
