<?php

declare(strict_types=1);

namespace Bree\Bases;

use Bree\Contracts\IsType;

abstract class BaseType implements IsType
{
    public function __construct(bool $nullable = false)
    {
        $this->nullable = $nullable;
    }
}
