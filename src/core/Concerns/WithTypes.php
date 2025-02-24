<?php

declare(strict_types=1);

namespace Bridget\Concerns;

use Bridget\Contracts\IsType;
use Bridget\Enums\BuiltinType;

trait WithTypes
{
    /**
     * @var array<IsType>
     */
    protected array $types;

    public function getTypes(): array
    {
        return $this->types;
    }

    public function hasType(string|BuiltinType|IsType $type): bool
    {
        foreach ($this->getTypes() as $type) {
            if ($type->is($type)) {
                return true;
            }
        }

        return false;
    }
}
