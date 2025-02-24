<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use BadMethodCallException as BaseException;
use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;

class BadMethodCallException extends BaseException implements IsException
{
    use CanCreateException;
}
