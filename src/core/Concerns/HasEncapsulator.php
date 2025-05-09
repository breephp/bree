<?php

declare(strict_types=1);

namespace Bree\Concerns;

trait HasEncapsulator
{
    use HasAccessor;
    use HasModifier;
    use HasResolver;
}
