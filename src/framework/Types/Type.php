<?php

declare(strict_types=1);

namespace Bree\Types;

use Bree\Bases\BaseType;
use Bree\Concerns\AsType;

abstract class Type extends BaseType
{
    use AsType;
}
