<?php

declare(strict_types=1);

namespace Bree\Exceptions;

use BadMethodCallException as BaseException;
use Bree\Concerns\CanCreateException;
use Bree\Contracts\IsException;

class BadMethodCallException extends BaseException implements IsException
{
    use CanCreateException;
}
