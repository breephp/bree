<?php

declare(strict_types=1);

namespace Bridget\Types;

use Bridget\Concerns\AsIntersectionType;
use Bridget\Contracts\IsIntersectionType;
use Bridget\Contracts\IsType;

final class IntersectionType extends Type implements IsIntersectionType
{
    use AsIntersectionType;

    public function __construct(bool $nullable = false, IsType ...$types)
    {
        parent::__construct($nullable);
        $this->types = $types;
    }
}
