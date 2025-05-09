<?php

declare(strict_types=1);

namespace Bree\Exceptions;

use Bree\Concerns\CanCreateException;
use Bree\Contracts\IsException;
use OutOfRangeException as BaseException;

class OutOfRangeException extends BaseException implements IsException
{
    use CanCreateException;
}
