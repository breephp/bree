<?php

declare(strict_types=1);

namespace Bree\Exceptions;

use Bree\Concerns\CanCreateException;
use Bree\Contracts\IsException;
use LogicException as BaseException;

class LogicException extends BaseException implements IsException
{
    use CanCreateException;
}
