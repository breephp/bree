<?php

declare(strict_types=1);

namespace Bree\Types;

use Bree\Concerns\AsUnionType;
use Bree\Contracts\IsType;
use Bree\Contracts\IsUnionType;

final class UnionType extends Type implements IsUnionType
{
    use AsUnionType;

    public function __construct(bool $nullable = false, IsType ...$types)
    {
        parent::__construct($nullable);
        $this->types = $types;
    }
}
