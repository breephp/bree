<?php

declare(strict_types=1);

namespace Bridget\Types;

use Bridget\Concerns\AsNamedType;
use Bridget\Contracts\IsNamedType;
use Bridget\Enums\BuiltinType;

final class NamedType extends Type implements IsNamedType
{
    use AsNamedType;

    public function __construct(string|BuiltinType $name, bool $nullable = false)
    {
        parent::__construct($nullable);

        if ($name instanceof BuiltinType) {
            $name = $name->value;
        }

        $this->name = $name;
    }
}
