<?php

declare(strict_types=1);

namespace Bridget\Types;

use Bridget\Concerns\AsUnionType;
use Bridget\Contracts\IsType;
use Bridget\Contracts\IsUnionType;

final class UnionType extends Type implements IsUnionType
{
    use AsUnionType;

    public function __construct(bool $nullable = false, IsType ...$types)
    {
        parent::__construct($nullable);
        $this->types = $types;
    }
}
