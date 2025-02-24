<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;
use UnderflowException as BaseException;

class UnderflowException extends BaseException implements IsException
{
    use CanCreateException;
}
