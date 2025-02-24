<?php

declare(strict_types=1);

namespace Bridget\Types;

use Bridget\Bases\BaseType;
use Bridget\Concerns\AsType;

abstract class Type extends BaseType
{
    use AsType;
}
