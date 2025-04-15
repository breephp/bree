<?php

declare(strict_types=1);

namespace Bree\Types;

use Bree\Concerns\AsNamedType;
use Bree\Contracts\IsNamedType;
use Bree\Enums\BuiltinType;

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
