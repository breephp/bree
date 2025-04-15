<?php

declare(strict_types=1);

namespace Bree\Types;

use Bree\Concerns\AsIntersectionType;
use Bree\Contracts\IsIntersectionType;
use Bree\Contracts\IsType;

final class IntersectionType extends Type implements IsIntersectionType
{
    use AsIntersectionType;

    public function __construct(bool $nullable = false, IsType ...$types)
    {
        parent::__construct($nullable);
        $this->types = $types;
    }
}
