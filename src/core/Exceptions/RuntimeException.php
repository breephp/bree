<?php

declare(strict_types=1);

namespace Bree\Exceptions;

use Bree\Concerns\CanCreateException;
use Bree\Contracts\IsException;
use RuntimeException as BaseException;

class RuntimeException extends BaseException implements IsException
{
    use CanCreateException;
}
