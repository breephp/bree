<?php

declare(strict_types=1);

namespace Bree\Bases;

use Bree\Contracts\IsParameter;
use Bree\Contracts\IsType;
use Bree\Enums\TypeName;

abstract class BaseParameter implements IsParameter
{
    public function __construct(string|TypeName|IsType $type, string $name, mixed $value)
    {
        $this->setType($type)->setName($name)->setValue($value);
    }
}
