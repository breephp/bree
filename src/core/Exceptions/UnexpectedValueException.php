<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;
use UnexpectedValueException as BaseException;

class UnexpectedValueException extends BaseException implements IsException
{
    use CanCreateException;
}
