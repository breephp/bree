<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;
use InvalidArgumentException as BaseException;

class InvalidArgumentException extends BaseException implements IsException
{
    use CanCreateException;
}
