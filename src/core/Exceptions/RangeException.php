<?php

declare(strict_types=1);

namespace Bree\Exceptions;

use Bree\Concerns\CanCreateException;
use Bree\Contracts\IsException;
use RangeException as BaseException;

class RangeException extends BaseException implements IsException
{
    use CanCreateException;
}
