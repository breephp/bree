<?php

declare(strict_types=1);

namespace Bridget\Bases;

use Bridget\Contracts\IsParameter;
use Bridget\Contracts\IsType;
use Bridget\Enums\TypeName;

abstract class BaseParameter implements IsParameter
{
    public function __construct(string|TypeName|IsType $type, string $name, mixed $value)
    {
        $this->setType($type)->setName($name)->setValue($value);
    }
}
