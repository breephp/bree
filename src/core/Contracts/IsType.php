<?php

declare(strict_types=1);

namespace Bridget\Contracts;

use Bridget\Enums\BuiltinType;
use Stringable;

interface IsType extends Stringable
{
    public function is(string|BuiltinType|self $type): bool;

    public function allowsNull(): bool;
}
