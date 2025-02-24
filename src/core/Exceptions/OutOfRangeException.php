<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;
use OutOfRangeException as BaseException;

class OutOfRangeException extends BaseException implements IsException
{
    use CanCreateException;
}
