<?php

declare(strict_types=1);

namespace Bree\Exceptions;

use Bree\Concerns\CanCreateException;
use Bree\Contracts\IsException;
use OverflowException as BaseException;

class OverflowException extends BaseException implements IsException
{
    use CanCreateException;
}
