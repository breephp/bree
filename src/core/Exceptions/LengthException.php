<?php

declare(strict_types=1);

namespace Bree\Exceptions;

use Bree\Concerns\CanCreateException;
use Bree\Contracts\IsException;
use LengthException as BaseException;

class LengthException extends BaseException implements IsException
{
    use CanCreateException;
}
