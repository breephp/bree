<?php

declare(strict_types=1);

namespace Bree\Concerns;

use Bree\Contracts\IsType;
use Bree\Contracts\IsUnionType;
use Bree\Enums\BuiltinType;
use Bree\Types\IsIntersectionType;

trait AsUnionType
{
    use AsType;
    use WithTypes;

    public function is(string|BuiltinType|IsType $type): bool
    {
        foreach ($this->types as $type) {
            if ($type->is($type)) {
                return true;
            }
        }

        return false;
    }

    public function __toString(): string
    {
        $formats = [];

        foreach ($this->getTypes() as $type) {
            $formats[] = $type instanceof IsUnionType || $type instanceof IsIntersectionType ? "({$type})" : "{$type}";
        }

        return implode('|', $formats);
    }
}
