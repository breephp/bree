<?php

declare(strict_types=1);

namespace Bree\Exceptions;

use Bree\Concerns\CanCreateException;
use Bree\Contracts\IsException;
use UnderflowException as BaseException;

class UnderflowException extends BaseException implements IsException
{
    use CanCreateException;
}
