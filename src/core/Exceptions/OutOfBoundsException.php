<?php

declare(strict_types=1);

namespace Bree\Exceptions;

use Bree\Concerns\CanCreateException;
use Bree\Contracts\IsException;
use OutOfBoundsException as BaseException;

class OutOfBoundsException extends BaseException implements IsException
{
    use CanCreateException;
}
