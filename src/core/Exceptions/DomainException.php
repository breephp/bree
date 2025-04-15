<?php

declare(strict_types=1);

namespace Bree\Exceptions;

use Bree\Concerns\CanCreateException;
use Bree\Contracts\IsException;
use DomainException as BaseException;

class DomainException extends BaseException implements IsException
{
    use CanCreateException;
}
