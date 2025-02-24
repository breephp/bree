<?php

declare(strict_types=1);

namespace Bridget\Contracts;

use Bridget\Enums\BuiltinType;

interface HasTypes
{
    /**
     * @return array<IsType>
     */
    public function getTypes(): array;

    public function hasType(string|BuiltinType|IsType $type): bool;
}
