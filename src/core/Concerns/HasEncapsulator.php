<?php

declare(strict_types=1);

namespace Bridget\Concerns;

trait HasEncapsulator
{
    use HasAccessor;
    use HasModifier;
    use HasResolver;
}
