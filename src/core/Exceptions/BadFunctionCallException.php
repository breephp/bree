<?php

declare(strict_types=1);

namespace Bridget\Exceptions;

use BadFunctionCallException as BaseException;
use Bridget\Concerns\CanCreateException;
use Bridget\Contracts\IsException;

class BadFunctionCallException extends BaseException implements IsException
{
    use CanCreateException;
}
