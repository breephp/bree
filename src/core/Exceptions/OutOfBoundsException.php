<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;
use OutOfBoundsException as BaseException;

class OutOfBoundsException extends BaseException implements IsException
{
    use CanCreateException;
}
