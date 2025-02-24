<?php

declare(strict_types=1);

namespace Bridget\Contracts;

use Bridget\Enums\BuiltinType;

interface HasType
{
    public function setType(IsType $type): static;

    public function getType(): IsType;

    public function typeIs(string|BuiltinType|IsType $type): bool;
}
