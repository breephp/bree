<?php

declare(strict_types=1);

namespace Bridget\Enums;

enum BuiltinType: string
{
    case Bool = 'bool';

    case Int = 'int';

    case Float = 'float';

    case String = 'string';

    case Array = 'array';

    case Object = 'object';

    case Resource = 'resource';

    case Mixed = 'mixed';
}
