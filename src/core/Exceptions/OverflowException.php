<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;
use OverflowException as BaseException;

class OverflowException extends BaseException implements IsException
{
    use CanCreateException;
}
